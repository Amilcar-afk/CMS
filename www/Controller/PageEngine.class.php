<?php


namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\View;
use App\Model\Page;
use App\Model\Section;
use App\Model\PageSection;
use App\Model\Component;
use App\Model\ComponentTranslation;
use App\Model\Translation;


class PageEngine
{
    public $page;
    public function __construct()
    {
        $this->page = new Page();
    }



    public function deletePage(){

    }

    public function listPage(){



        $view = new View("page-editor", "back");
        $view->assign("user",$this->page);
    }

    public function composePage()
    {


        $_POST['page'] = [
            "meta"=>[
                "date_update"=>"",
                "user_key"=>"1",
                "status"=>"",
                "title"=>"page okok",
                "background"=>"ffffff",
                "description"=>"pq pas"
            ],
            "sections"=>[
                [
                    "bessels"=>"1",
                    "background"=>"ffffff",
                    "place"=>"1",
                    "components"=>[
                        [
                            "type"=>"1",
                            "place"=>"1",
                            "width"=>"2",
                            "highlight"=>"1",
                            "font"=>"1",
                            "font_size"=>"12",
                            "font_weight"=>"1",
                            "color"=>"ffffff",
                            "background"=>"ffffff",
                            "align"=>"1",
                            "contents"=>[
                                [
                                    "content"=>"oui",
                                    "description"=>"description",
                                ]
                            ]
                        ],
                    ],
                ],
            ],
        ];

        if(isset($_POST['page']))
        {

            //$_POST['page'] = stripslashes(html_entity_decode($_POST['page']));
            //$_POST['page'] = json_decode($_POST['page'], true);

            //$this->page->save();

            //foreach sur les sections
            if(!empty($_POST['page']["sections"]))
            {

            }
        }

        // CREER LA NOUVELLE VIEW
        $view = new View("page-editor", "back");
        //$view->assign("user",$this->user);
    }

    public function logout()
    {
        echo "Se deco";
    }

    public function register()
    {
        if( !empty($_POST)){
            $result = Validator::run($this->user->getFormRegister(), $_POST);
            if(empty($result)){
                $this->user->setFirstname($_POST['firstname']);
                $this->user->setLastname($_POST['lastname']);
                $this->user->setPassword($_POST['password']);
                $this->user->setEmail($_POST['email']);
                $this->user->save();
            }else{
                print_r($result);
            }
        }
        $e = 1;
        $view = new View("register");
        $view->assign("user",$this->user);
    }
}