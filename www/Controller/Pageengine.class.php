<?php


namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Page;
use App\Model\Option;
use App\Model\Categorie;
use App\Model\Page_categorie;
use App\Core\Query;
use App\Model\Reseaux_soc;
use SimpleXMLElement;

class Pageengine
{
    public $page;

    public function __construct()
    {
        $this->page = new Page();
    }

    public function siteMap()
    {
        if (isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        }
        else {
            $protocol = 'http://';
        }
        $pages = Query::from('cmspf_Pages')->where("status = 'Public'")->execute('Page');
        $xml = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8' ?>\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');
        foreach($pages as $page){
            $url = $xml->addChild('url'); 
            $url->addChild('loc',$protocol.$_SERVER['SERVER_NAME'].'/'.$page->getSlug() );  
            $url->addChild('lastmod',$page->getDateUpdate() );  
        }
        header("Content-type: application/xml; charset=utf-8");
        $view = new View("sitemap");
        $view->assign("xml", $xml);
        $xml->asXML('./View/sitemap.view.php');

    }




    public function deletePage(){
        if( isset($_POST['id']) && $_POST['id'] != 1 ) {
            $page = $this->page->find($_POST['id']);
            if ($page->getId() != null) {

                $pageCategories = Query::from('cmspf_Page_categorie')->where("page_key = " . $_POST['id'] . "")->execute('Page_categorie');
                foreach ($pageCategories as $pageCategorie)
                {
                    $pageCategorie->delete($pageCategorie->getId());
                }
                Query::deleteAll('')->from('cmspf_Stats')->where("page_key = " . $_POST['id'] . "")->execute();
                $page->delete($_POST['id']);
            }else{
                http_response_code(422);
            }
        }else{
            http_response_code(422);
        }
    }

    public function pageLoader($request){

        $page = $this->page->find($request['slug'], 'slug');

        if ($page && ($page->getStatus() == 'Public' || $page->getStatus() == 'Tag')) {

            $page->composeStats($page->getId(), "view");

            //load Categorie list if categorie page
            if ($page->getStatus() == 'Tag'){
                $categorie = new Categorie();
                $categorie = $categorie->find($page->getCategorieKey());
                $view = new View("load-categorie-page", "front");
                $view->assign("categorie", $categorie);
            }else{
                $view = new View("load-page", "front");
            }

            $headCode = Query::from('cmspf_Options')->where("type = 'headCode'")->execute('Option');
            $footerCode = Query::from('cmspf_Options')->where("type = 'footerCode'")->execute('Option');

            $bessels = Query::from('cmspf_Options')
                ->where("type = 'bessels'")
                ->execute('Option');

            $view->assign("page", $page );
            $view->assign("headCode", (isset($headCode[0]) && $headCode[0]->getValue() != null)?$headCode[0]->getValue():"");
            $view->assign("footerCode", (isset($footerCode[0]) && $footerCode[0]->getValue() != null)?$footerCode[0]->getValue():"");
            $view->assign("bessels", $bessels);
            $view->assign("metaData", $metaData = [
                "title" => $page->getTitle(),
                "description" => $page->getDescription(),
                "src" => [
                    ["type" => "js", "path" => "/style/js/subscribe.js"],
                ],
            ]);
        }else{
            http_response_code(404);
            $view = new View("error", 'back-sandbox');
            $view->assign("metaData", $metaData = [
                "title" => 'Error',
                "description" => 'Error',
            ]);
            die();
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
        $view->assign("metaData", $metaData = [
            "title" => 'Pages',
            "description" => 'List of pages',
            "src" => [
                ["type" => "js", "path" => "../style/js/pages.js"],
            ],
        ]);
    }

    public function buildPage($request){
        $categories = Query::from('cmspf_Pages')->where("status = 'Tag'")->execute('Page');
        $pages = Query::from('cmspf_Pages')->where("status = 'Public'")->execute('Page');
        $page = $this->page->find($request['slug'], 'slug');

        if ($page){

            $view = new View("page-editor", "back");
            $view->assign("page", $page);
            $view->assign("pages", $pages);
            $view->assign("categories", $categories);
            $view->assign("metaData", $metaData = [
                "title" => 'Page builder',
                "description" => 'Page builder',
                "src" => [
                    ["type" => "js", "path" => "../style/js/wysiwyg.js"],
                    ["type" => "js", "path" => "https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"],
                    ["type" => "css", "path" => "https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css"],
                ],
            ]);
        }else {
            http_response_code(422);
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
            
            $this->page->setDateUpdate(date('d-m-y h:i:s'));

            if (isset($_POST['id']) && $_POST['id'] != null) {  
                if (!$this->page->find($_POST['id'])){
                    http_response_code(422);
                    return include "View/Partial/form.partial.php";
                }
                $this->page->setId($_POST['id']);
                $unic_page = Query::from('cmspf_Pages')
                    ->where("slug = '" . $_POST['slug'] . "'")
                    ->where("id != " . $_POST['id'] . "")
                    ->execute('Page');
                if (!isset($unic_page[0])){
                    $unic_page = false;
                }else{
                    $unic_page = true;
                }
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
                        ->where("id = :id")->params(['id'=>$_POST['categorie']])
                        ->execute('Categorie')){

                    //use categorie template;
                    if ($this->page->getContent() == null){

                        $categories = Query::from('cmspf_Categories')
                            ->where("id = :id")->params(['id'=>$_POST['categorie']])
                            ->execute('Categorie');

                        $page_of_categorie = $categories[0]->page();

                        $this->page->setContent($page_of_categorie->getContent());
                        $this->page->setId($lastId);
                        $this->page->save();
                    }

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
                http_response_code(422);
            }
        }else{
            http_response_code(422);
        }
    }

    public function saveContentPage()
    {
        if( isset($_POST)
            && isset($_POST['id'])
            && isset($_POST['content']) ){

            if ($this->page->find($_POST['id'])){

                if(isset($_POST['status']) && $_POST['status'] == 'Public'){
                    $this->page->setStatus($_POST['status']);
                }

                $this->page->setId($_POST['id']);
                $this->page->setContent($_POST['content']);
                $this->page->save();
            }else{
                http_response_code(422);
            }
        }else{
            http_response_code(422);
        }

    }

    public function listAddCode(){

        $headCode = Query::from('cmspf_Options')->where("type = 'headCode'")->execute('Option');
        $footerCode = Query::from('cmspf_Options')->where("type = 'footerCode'")->execute('Option');

        $view = new View("add-code", "back");
        $view->assign("headCode", $headCode);
        $view->assign("footerCode", $footerCode);
        $view->assign("metaData", $metaData = [
            "title" => 'Add code',
            "description" => 'Add js or css code in your website',
            "src" => [
                ["type" => "js", "path" => "../style/js/addCode.js"],
            ],
        ]);
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
        $footerCode->setValue((!empty($_POST['footerCode']))? $_POST['footerCode'] : ' ');
        $headCode->setValue((!empty($_POST['headCode']))? $_POST['headCode'] : ' ');
        $footerCode->setType('footerCode');
        $headCode->setType('headCode');
        $footerCode->setUserKey($_SESSION['Auth']->id);
        $headCode->setUserKey($_SESSION['Auth']->id);
        $footerCode->save();
        $headCode->save();
    }
}