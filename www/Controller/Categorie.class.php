<?php

namespace App\Controller;
use App\Core\View;
use App\Core\Validator;
use App\Model\Categorie as Categorie_model;
use App\Model\Categorie_categorie;
use App\Core\Query;
use App\Model\Page;
use App\Model\Page_categorie;

class Categorie{

    public $categorie;

    public function __construct()
    {
        $this->categorie = new Categorie_model();
    }


    public function categoriesList()
    {
        $categorieEmpty = $this->categorie;
        $categories = Query::from('cmspf_Categories')->where("type = 'tag'")->execute('Categorie');
        $navigations = Query::from('cmspf_Categories')->where("type = 'nav'")->execute('Categorie');
        $view = new View("categorie-list", "back");
        $view->assign("categories",$categories);
        $view->assign("navigations", $navigations);
        $view->assign("categorieEmpty", $categorieEmpty);
        $view->assign("metaData", $metaData = [
            "title" => 'Categories',
            "description" => 'List of all categories',
            "src" => [
                ["type" => "js", "path" => "../style/js/categorie.js"],
            ],
        ]);
    }

    public function navigationsList()
    {
        $navigations = Query::from('cmspf_Categories')->where("type = 'nav'")->execute('Categorie');
        $view = new View("navigation-list", "back");
        $view->assign("navigations",$navigations);
        $view->assign("metaData", $metaData = [
            "title" => 'Categories',
            "description" => 'List of all categories',
            "src" => [
                ["type" => "js", "path" => "../style/js/navigations.js"],
                ["type" => "js", "path" => "https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"],
                ["type" => "css", "path" => "https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css"],
            ],
        ]);
    }


    public function composeCategorie()
    {
        if( isset($_POST) ) {
            $categorieEmpty = $this->categorie;

            $this->categorie->setTitle($_POST['title']);
            $this->categorie->setType('tag');
            if (isset($_POST['id']) && $_POST['id'] != null) {
                if (!$this->categorie->find($_POST['id'])){
                    return include "View/Partial/form.partial.php";
                }
                $this->categorie->setId($_POST['id']);
            }
            $navigations = Query::from('cmspf_Categories')->where("type = 'nav'")->execute('Categorie');
            $config = Validator::run($this->categorie->getFormNewCategorie($navigations), $_POST);

            if (empty($config)) {
                $this->categorie->save();

                $lastId = $this->categorie->getLastId();

                if ($lastId) {
                    $page = Query::from('cmspf_Pages')
                        ->where("categorie_key = " . $lastId . "")
                        ->execute('Page');

                    if (isset($page[0])){
                        $page = $page[0];
                    }else {
                        $page = new Page();
                        $page->setCategorieKey($lastId);
                    }
                    $page->setStatus('tag');
                    $page->setSlug($_POST['title']);
                    $page->setTitle($_POST['title']);
                    $page->setUserKey($_SESSION['Auth']->id);
                    $page->setDateUpdate(date('d-m-y h:i:s'));
                    $page->save();
                }

                if ($lastId
                    && isset($_POST['navigation'])
                    && Query::from('cmspf_Categories')
                        ->where("id = " . $_POST['navigation'] . "")
                        ->execute('Categorie')) {

                    $categorie_categorie = Query::from('cmspf_Categorie_categorie')
                        ->where("categorie_child_key = " . $lastId . "")
                        ->execute('Categorie_categorie');

                    if (isset($categorie_categorie[0])){
                        $categorie_categorie = $categorie_categorie[0];
                    }else {
                        $categorie_categorie = new Categorie_categorie();
                    }

                    $categorie_categorie->setCategorieChildKey($lastId);
                    $categorie_categorie->setCategorieParentKey($_POST['navigation']);
                    $categorie_categorie->save();
                }

                $categories = Query::from('cmspf_Categories')->where("type = 'tag'")->execute('Categorie');
                $navigations = Query::from('cmspf_Categories')->where("type = 'nav'")->execute('Categorie');
                $view = new View("categorie-list");
                $view->assign("categories", $categories);
                $view->assign("navigations", $navigations);
                $view->assign("categorieEmpty", $categorieEmpty);
            } else {
                return include "View/Partial/form.partial.php";
            }
        }else{
            http_response_code(500);
        }
    }

    public function categoriedelete()
    {
        if( isset($_POST['id']) ) {
            $categorie = $this->categorie->find($_POST['id']);
            if ($categorie->getId() != null && $categorie->getType() == 'tag') {

                $categorieCategories = Query::from('cmspf_Categorie_categorie')->where("categorie_child_key = " . $_POST['id'] . "")->execute('Categorie_categorie');
                foreach ($categorieCategories as $categorieCategorie)
                {
                    $categorieCategorie->delete($categorieCategorie->getId());
                }
                $categorie->delete($_POST['id']);
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(500);
        }
    }

    public function composeNavigationPage()
    {
        if( isset($_POST['page']) && isset($_POST['navigation']) ) {
            $page = new Page();
            $page = $page->find($_POST['page']);

            $navigation = new Categorie_model();
            $navigation = $navigation->find($_POST['navigation']);

            if ($navigation->getId() != null && $page->getId() != null){
                $page_categorie = Query::from('cmspf_Page_categorie')
                    ->where("page_key = " . $_POST['page'] . "")
                    ->where("categorie_key = " . $_POST['navigation'] . "")
                    ->execute('Page_categorie');

                if (!isset($page_categorie[0])){
                    $page_categorie = new Page_categorie();
                    $page_categorie->setPagekey($_POST['page']);
                    $page_categorie->setCategorieKey($_POST['navigation']);
                    $page_categorie->save();
                }
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(500);
        }
    }

    public function composeNavigationOption()
    {
        if( isset($_POST['type']) && isset($_POST['value']) && isset($_POST['navigation']) ) {

            if (!$this->categorie->find($_POST['navigation'])){
                return http_response_code(500);
            }

            if ($_POST['type'] == 'backgroundColor'){
                $this->categorie->setBackgroundColor($_POST['value']);
            }elseif ($_POST['type'] == 'btnColor'){
                $this->categorie->setBtnColor($_POST['value']);
            }elseif ($_POST['type'] == 'btnTextColor'){
                $this->categorie->setBtnTextColor($_POST['value']);
            }elseif ($_POST['type'] == 'btnTextHoverColor'){
                $this->categorie->setBtnTextHoverColor($_POST['value']);
            }
            $this->categorie->setId($_POST['navigation']);

            $this->categorie->save();

        }else{
            http_response_code(500);
        }
    }

    public function deleteNavigationPage()
    {
        if( isset($_POST['page']) && isset($_POST['navigation']) ) {
            $page_categorie = Query::from('cmspf_Page_categorie')
                ->where("page_key = " . $_POST['page'] . "")
                ->where("categorie_key = " . $_POST['navigation'] . "")
                ->execute('Page_categorie');

            if (isset($page_categorie[0])){
                $page_categorie[0]->delete($page_categorie[0]->getId());
            }
        }else{
            http_response_code(500);
        }
    }

    public function composeNavigationCategorie()
    {
        if( isset($_POST['categorie']) && isset($_POST['navigation']) ) {
            $categorie = new Categorie_model();
            $categorie = $categorie->find($_POST['categorie']);

            $navigation = new Categorie_model();
            $navigation = $navigation->find($_POST['navigation']);

            if ($navigation->getId() != null && $categorie->getId() != null){
                $categorie_categorie = Query::from('cmspf_Categorie_categorie')
                    ->where("categorie_child_key = " . $_POST['categorie'] . "")
                    ->where("categorie_parent_key = " . $_POST['navigation'] . "")
                    ->execute('Categorie_categorie');

                if (!isset($categorie_categorie[0])){
                    $categorie_categorie = new Categorie_categorie();
                    $categorie_categorie->setCategorieChildKey($_POST['categorie']);
                    $categorie_categorie->setCategorieParentKey($_POST['navigation']);
                    $categorie_categorie->save();
                }
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(500);
        }
    }

    public function deleteNavigationCategorie()
    {
        if( isset($_POST['categorie']) && isset($_POST['navigation']) ) {
            $categorie_categorie = Query::from('cmspf_Categorie_categorie')
                ->where("categorie_child_key = " . $_POST['categorie'] . "")
                ->where("categorie_parent_key = " . $_POST['navigation'] . "")
                ->execute('Categorie_categorie');

            if (isset($categorie_categorie[0])){
                $categorie_categorie[0]->delete($categorie_categorie[0]->getId());
            }
        }else{
            http_response_code(500);
        }
    }
}