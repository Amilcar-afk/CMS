<?php


namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Page;
use App\Model\Option;
use App\Model\Page_categorie;
use App\Core\Query;

class Pageengine
{
    public $page;

    public function __construct()
    {
        $this->page = new Page();
    }


    public function deletePage(){
        if( isset($_POST['id']) ) {
            $page = $this->page->find($_POST['id']);
            if ($page->getId() != null) {

                $pageCategories = Query::from('cmspf_Page_categorie')->where("page_key = " . $_POST['id'] . "")->execute('Page_categorie');
                foreach ($pageCategories as $pageCategorie)
                {
                    $pageCategorie->delete($pageCategorie->getId());
                }
                Query::deleteAll('')->from('cmspf_Stats')->where("page_key = " . $_POST['id'] . "")->execute();
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(500);
        }
    }

    public function pageLoader($request){

        $headCode = Query::from('cmspf_Options')->where("type = 'headCode'")->execute('Option');
        $footerCode = Query::from('cmspf_Options')->where("type = 'footerCode'")->execute('Option');


        $page = $this->page->find($request['slug'], 'slug');

        if (true){

            $page->composeStats($page->getId(), "view");

            $view = new View("load-page", "front");
            $view->assign("page", $page );
            $view->assign("headCode", $headCode);
            $view->assign("footerCode", $footerCode);
        }else{
            http_response_code(404);
        }

    }

    public function listPage(){
        $pageEmpty = $this->page;
        $pages = $this->page->find();

        $categories = Query::from('cmspf_Categories')->where("type = 'tag'")->execute('Categorie');

        $view = new View("page-list", "back");
        $view->assign("pages", $pages);
        $view->assign("categories", $categories);
        $view->assign("pageEmpty", $pageEmpty);
    }

    public function buildPage($request){

        $page = $this->page->find($request['slug'], 'slug');

        if (true){
            $view = new View("page-editor", "back");
            $view->assign("page", $page);
        }else {
            http_response_code(404);;
        }
    }

    public function composePage()
    {
        if( isset($_POST) ) {
            $this->page->setTitle($_POST['title']);
            $this->page->setSlug(str_replace(' ', '-', strtolower(trim($_POST['slug']))));
            $this->page->setStatus($_POST['status']);
            $this->page->setDescription($_POST['description']);
            $this->page->setUserKey($_SESSION['Auth']->id);
            if (isset($_POST['id']) && $_POST['id'] != null) {
                if (!$this->page->find($_POST['id'])){
                    return include "View/Partial/form.partial.php";
                }
                $this->page->setId($_POST['id']);
                $unic_page = Query::from('cmspf_Pages')
                    ->where("slug = '" . $_POST['slug'] . "'")
                    ->where("id = " . $_POST['id'] . "")
                    ->execute('Page');
            }else{
                $unic_page = $this->page->find($_POST['slug'], 'slug');
            }
            $categories = Query::from('cmspf_Categories')->where("type = 'tag'")->execute('Categorie');
            $config = Validator::run($this->page->getFormNewPage($categories), $_POST, $unic_page);

            if (empty($config)) {
                $this->page->save();

                $lastId = $this->page->getLastId();

                if ($lastId
                    && isset($_POST['categorie'])
                    && Query::from('cmspf_Categories')
                        ->where("id = " . $_POST['categorie'] . "")
                        ->execute('Categorie')) {

                    $page_categorie = Query::from('cmspf_Page_categorie')
                        ->where("page_key = " . $lastId . "")
                        ->execute('Page_categorie');

                    if (isset($page_categorie[0])){
                        $page_categorie = $page_categorie[0];
                    }else {
                        $page_categorie = new Page_categorie();
                    }

                    $page_categorie->setPagekey($lastId);
                    $page_categorie->setCategorieKey($_POST['categorie']);
                    $page_categorie->save();
                }

                $pageEmpty = $this->page;
                $pages = $this->page->find();
                $view = new View("page-list");
                $view->assign("pages", $pages);
                $view->assign("categories", $categories);
                $view->assign("pageEmpty", $pageEmpty);
            } else {
                return include "View/Partial/form.partial.php";
            }
        }else{
            http_response_code(500);
        }
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

        $headCode = Query::from('cmspf_Options')->where("type = 'headCode'")->execute('Option');
        $footerCode = Query::from('cmspf_Options')->where("type = 'footerCode'")->execute('Option');

        $view = new View("add-code", "back");
        $view->assign("headCode", $headCode);
        $view->assign("footerCode", $footerCode);
    }

    public function composeAddCode(){
        $headCode = Query::from('cmspf_Options')->where("type = 'headCode'")->execute('Option');
        $footerCode = Query::from('cmspf_Options')->where("type = 'footerCode'")->execute('Option');

        if (!$headCode[0]) {
            $headCode = new Option();
        }else{
            $headCode = $headCode[0];
        }
        if (!$footerCode[0]) {
            $footerCode = new Option();
        }else{
            $footerCode = $footerCode[0];
        }
        $footerCode->setValue($_POST['footerCode']);
        $headCode->setValue($_POST['headCode']);
        $footerCode->setType('footerCode');
        $headCode->setType('headCode');
        $footerCode->setUserKey($_SESSION['Auth']->id);
        $headCode->setUserKey($_SESSION['Auth']->id);
        $footerCode->save();
        $headCode->save();
    }
}