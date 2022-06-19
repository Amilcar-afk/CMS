<?php

namespace App\Controller;
use App\Core\View;
use App\Core\Validator;
use App\Model\Categorie as Categorie_model;
use App\Model\Categorie_categorie;
use App\Core\Query;

class Categorie{

    public $categorie;

    public function __construct()
    {
        $this->categorie = new Categorie_model();
    }


    public function categoriesList()
    {
        $categories = Query::from('cmspf_Categories')->where("type = 'tag'")->execute('Categorie');
        $navigations = Query::from('cmspf_Categories')->where("type = 'nav'")->execute('Categorie');
        $view = new View("categorie-list", "back");
        $view->assign("categories",$categories);
        $view->assign("navigations", $navigations);

    }

    public function navigationsList()
    {
        $navigations = Query::from('cmspf_Categories')->where("type = 'nav'")->execute('Categorie');
        $view = new View("navigation-list", "back");
        $view->assign("navigations",$navigations);
    }


    public function composeCategorie()
    {
        if( isset($_POST) ) {
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
                    $categorie_categorie->setCategorieParentKey($_POST['categorie']);
                    $categorie_categorie->save();
                }

                $categories = Query::from('cmspf_Categories')->where("type = 'tag'")->execute('Categorie');
                $navigations = Query::from('cmspf_Categories')->where("type = 'nav'")->execute('Categorie');
                $view = new View("categorie-list");
                $view->assign("categories", $categories);
                $view->assign("navigations", $navigations);
            } else {
                return include "View/Partial/form.partial.php";
            }
        }else{
            http_response_code(500);
        }
    }

    public function categoriedelete($id)
    {
        if(isset($id))
        {
            $this->categorie->deleteCategorie($this->categorie->setId($id['id']));
            header('location:/categories');
        }
    }

}