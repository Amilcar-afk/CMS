<?php


namespace App\Controller;

use App\Core\Validator;
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
        $pages = $this->page->find();
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
            $this->page->setTitle($_POST['title']);
            $this->page->setSlug($_POST['slug']);
            $this->page->setStatus($_POST['status']);
            $this->page->setDescription($_POST['description']);
            $this->page->setUserKey($_SESSION['Auth']->id);
            $unic_page = $this->page->find($_POST['slug'],'slug');
            if (isset($_POST['id']))
                $this->page->setId($_POST['id']);
            $result = Validator::run($this->page->getFormNewPage(), $_POST,$unic_page);

            if(empty($result)){
                $this->page->save();
            }

        // CREER LA NOUVELLE VIEW
        //$view = new View("page-editor", "back");
        //$view->assign("page",$this->page);
    }

    public function saveContentPage()
    {
        if( isset($_POST)
            && isset($_POST['id'])
            && isset($_POST['content']) )

            $this->page->setId($_POST['id']);
            $this->page->setContent($_POST['content']);
            $this->page->save();
    }

    public function listAddCode(){
        //$pages = $this->page->find();;

        $view = new View("add-code", "back");
        //$view->assign("pages", $pages);
    }

    public function composeAddCode(){

    }
}