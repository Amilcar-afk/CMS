<?php


namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Newsletter;
use App\Core\Query;

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

    public function newsletterLoader($request){

        $newsletter = $this->newsletter->find($request['id'], 'slug');

        if ($newsletter){

            $view = new View("load-newsletter", "front");

            $view->assign("newsletter", $newsletter );
            $view->assign("metaData", $metaData = [
                "title" => $newsletter->getTitle()
            ]);
        }else{
            http_response_code(404);
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
        $newsletter = $this->newsletter->find($request['id']);

        if ($newsletter){

            $view = new View("newsletter-editor", "back");
            $view->assign("newsletter", $newsletter);
            $view->assign("metaData", $metaData = [
                "title" => 'Newsletter builder',
                "description" => 'Newsletter builder',
                "src" => [
                    ["type" => "js", "path" => "../style/js/wysiwyg.js"],
                ],
            ]);
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

    public function saveContentNewsletter()
    {
        if( isset($_POST)
            && isset($_POST['id'])
            && isset($_POST['content']) )

            $this->newsletter->setId($_POST['id']);
            $this->newsletter->setContent($_POST['content']);
            $this->newsletter->save();
    }
}