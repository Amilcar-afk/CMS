<?php


namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Model\Page;


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

        $pages = $this->page->find();

        $view = new View("page-manager", "back");
        $view->assign("pages", $pages);
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