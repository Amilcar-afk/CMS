<?php

namespace App\Controller;
use App\Core\View;
use App\Model\Categorie as Categorie_model;
use App\Controller\Authadmin;
use PDO;

class Categorie{

    public $categorie;
    public $authAdmin ;

    public function __construct()
    {
        $this->categorie = new Categorie_model();
        $this->authAdmin = new Authadmin();
    }


    public function categoriesList()
    {
        $allCategories = $this->categorie->getCategorie();
        $view = new View("categorielist", "back-sandbox");
        $view->assign("categories",$allCategories);
    }

    public function composeCategorie()
    {

        if($this->categorie->getParams()){

            $categorie = $this->categorie->getCategories($this->categorie->getParams()[0]);

            $this->categorie->setId($categorie->id);
            $this->categorie->setType($categorie->type);

            if(isset($_POST['id']) )
            {
                $this->categorie->setId($_POST['id']);
                $this->categorie->setType($_POST['type']);
                $this->categorie->save();
                header('location:/categories');

            }
            $view = new View("categorieupdate", "back-sandbox");
            $view->assign("categorie",$this->categorie);

        }else{

            if(!isset($_POST['id']) && isset($_POST['type']) )
            {
                $this->categorie->setType($_POST['type']);
                $this->categorie->save();
            }
            $view = new View("categorieinsert", "back-sandbox");
            $view->assign("categorie",$this->categorie);
        }
    }

    public function categoriedelete()
    {
        if($this->categorie->getParams())
        {
            $id = $this->categorie->getParams()[0];
            $this->categorie->deleteCategorie($this->categorie->setId($id));
            header('location:/categories');
        }

    }

}