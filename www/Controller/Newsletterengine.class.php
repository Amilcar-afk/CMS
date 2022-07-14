<?php


namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Newsletter;
use App\Core\Query;
use App\Model\Mail as MailModel;
use App\Model\Newsletter_subscriber;

class Newsletterengine
{
    public $newsletter;

    public function __construct()
    {
        $this->newsletter = new Newsletter();
    }

    public function deleteNewsletter(){
        if( isset($_POST['id']) ) {
            $newsletter = $this->newsletter->find($_POST['id']);
            if ($newsletter->getId() != null) {

                $newsletter->delete($_POST['id']);
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(500);
        }
    }

    public function listNewsletter(){
        $newsletterEmpty = $this->newsletter;
        $newsletters = $this->newsletter->find();

        $view = new View("newsletter-list", "back");
        $view->assign("newsletters", $newsletters);
        $view->assign("newsletterEmpty", $newsletterEmpty);
        $view->assign("metaData", $metaData = [
            "title" => 'Pages',
            "description" => 'List of $newsletters',
            "src" => [
                ["type" => "js", "path" => "../style/js/newsletter.js"],
            ],
        ]);
    }

    public function buildNewsletter($request){
        if (isset($request['id'])){
            $newsletter = $this->newsletter->find($request['id']);

            if ($newsletter){

                if ($newsletter->getContent() != null){
                    $message = $newsletter->getContent();
                }else{
                    $message = [
                        [
                            "type"=>'title',
                            "content"=>'Title'
                        ],
                        [
                            "type"=>'text',
                            "content"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo ante non pellentesque egestas. Phasellus elementum, augue vel facilisis blandit, odio odio vestibulum purus, ac venenatis lacus odio non metus. Morbi porttitor elit sem, in auctor massa sollicitudin et. Integer non magna vel nulla molestie viverra nec vel ligula. Sed rhoncus a neque eget laoreet. Ut eu ante eget ex consectetur congue. Maecenas placerat non risus eget tempus. Sed quis risus feugiat, tincidunt turpis in, feugiat dolor. Maecenas venenatis turpis et iaculis dictum."
                        ],
                        [
                            "type"=>'button',
                            "link"=>'http://www.google.com',
                            "content"=>'Button'
                        ]
                    ];
                }

                $view = new View("newsletter-editor", "back");
                $view->assign("newsletter", $newsletter);
                $view->assign("message", $message);
                $view->assign("metaData", $metaData = [
                    "title" => 'Newsletter builder',
                    "description" => 'Newsletter builder',
                    "src" => [
                        ["type" => "js", "path" => "/style/js/wysiwygNewsletter.js"],
                    ],
                ]);
            }else {
                http_response_code(404);
            }
        }else {
            http_response_code(404);
        }
    }

    public function composeNewsletter()
    {
        if( isset($_POST) ) {
            $this->newsletter->setTitle($_POST['title']);
            $this->newsletter->setStatus('Draft');
            $this->newsletter->setUserKey($_SESSION['Auth']->id);
            $this->newsletter->setDateUpdate(date('d-m-y h:i:s'));

            if (isset($_POST['id']) && $_POST['id'] != null) {  
                if (!$this->newsletter->find($_POST['id'])){
                    return include "View/Partial/form.partial.php";
                }
                $this->newsletter->setId($_POST['id']);
            }

            $config = Validator::run($this->newsletter->getFormNewNewsletter(), $_POST);

            if (empty($config)) {
                $this->newsletter->save();

                $newsletterEmpty = $this->newsletter;
                $newsletters = $this->newsletter->find();
                $view = new View("newsletter-list");
                $view->assign("newsletters", $newsletters);
                $view->assign("newsletterEmpty", $newsletterEmpty);
            } else {
                return include "View/Partial/form.partial.php";
            }
        }else{
            http_response_code(500);
        }
    }




    public function subscribe() {
        echo "test";
        if (isset($_POST['email'])) {
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                
                $newsletterSubscribe = new Newsletter_subscriber();
                $newsletterSubscribe = $newsletterSubscribe->find($_POST['email'], "email");
                if ($newsletterSubscribe) {
                    echo "You are already subscribe";
                } else {
                    $newsletterSubscribe->setEmail($_POST['email']);
                    $newsletterSubscribe->save();
                    echo "You have been subscribe !";
                }
            } else {
                echo "Bad email";    
            }
        } else {
            echo "Bad request";
        }

    }

    public function unsubscribe($client)
    {
        unset( $this->subscribedClients[ $client->id ] ); 
    }

    public function notify()
    {
        foreach ($this->subscribedClients as $client) {
            $client->update($this);
        }
    }

    public function update(Newsletter $newsletter) 
        {

            // SELECT firstname FROM cmspf_Users INNER JOIN cmspf_Newsletter_subscribers ON cmspf_Users.id = cmspf_Newsletter_subscribers.user_key; 
            $firstname = Query::select("firstname ")->from("cmspf_Users")->innerJoin(" cmspf_Newsletter_subscribers ON cmspf_Users.id = cmspf_Newsletter_subscribers.user_key")->execute();
            $mail = new MailModel();
            $mail->sendEmail(, $firstname, $this->$newsletter->getTitle(), $this->$newsletter->getContent());

        }


    public function saveContentNewsletter()
    {
        if (isset($_POST['id']) && isset($_POST['content']) && isset($_POST['status'])){
            $newsletter = $this->newsletter->find($_POST['id']);

            if ($newsletter){

                if ($_POST['status'] == 'Public'){

                    $this->newsletter->setDateRelease(date('d-m-y h:i:s'));
                    
                    

                }

                $this->newsletter->setId($_POST['id']);
                $this->newsletter->setStatus($_POST['status']);
                $this->newsletter->setContent($_POST['content']);
                $this->newsletter->save();
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(500);
        }
    }
}