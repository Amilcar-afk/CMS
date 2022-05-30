<?php


namespace App\Controller;

use App\Core\View;
use App\Model\Page;
use App\Core\Query;

class Pageengine
{
    public $page;
    public function __construct()
    {
        $this->page = new Page();
    }



    public function deletePage(){

    }

    public function pageLoader($request){

        $page = $this->page->find($request['slug'], 'slug');

        if (true){

            $page->composeStats($page->getId(), "view");

            $view = new View("load-page", "front");
            $view->assign("page", $page);
        }else{
            echo "error 404";
        }

    }

    public function listPage(){

        //$pages = $this->page->find();

        
        $pages = Query::from('cmspf_Pages')->execute();


        //$pages = (new Query())->from('cmspf_Pages')->execute();
        //echo $pages;
        //echo "<pre>";
        //print_r($pages);
        //echo "</pre>";
        $view = new View("page-list", "back");
        $view->assign("pages", $pages);
    }

    public function buildPage($request){


        $page = $this->page->find($request['slug'], 'slug');

        if (true){
            $view = new View("page-editor", "back");
            $view->assign("page", $page);
        }else {
            echo "error 404";
        }
    }

    public function composePage()
    {
        if( isset($_POST) )

            //$result = Validator::run($this->page->getFormNewPage(), $_POST);
            if (isset($_POST['id']))
                $this->page->setId($_POST['id']);

            $this->page->setTitle($_POST['title']);
            $this->page->setSlug($_POST['slug']);
            $this->page->setStatus($_POST['status']);
            $this->page->setDescription($_POST['description']);
            $this->page->setUserKey($_SESSION['Auth']->id);
            $this->page->save();

        // CREER LA NOUVELLE VIEW
        $view = new View("page-editor", "back");
        $view->assign("page",$this->page);
    }
}