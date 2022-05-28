<?php

namespace App\Controller;
use App\Core\View;
use App\Model\Categorie as Categorie_model;


class Categorie{

    public $categorie;
    public $authAdmin ;

    public function __construct()
    {
        $this->categorie = new Categorie_model();
    }


    public function categoriesList()
    {
        $allCategories = $this->categorie->find();
        $view = new View("categorielist", "back-sandbox");
        $view->assign("categories",$allCategories);
    }

    public function composeCategorie($id)
    {
        if(isset($id)){
        $categorie = $this->categorie->find($id['id']);

            $this->categorie->setId($categorie->getId());
            $this->categorie->setType($categorie->getType());
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

    public function categoriedelete($id)
    {
        if(isset($id))
        {
            $this->categorie->deleteCategorie($this->categorie->setId($id['id']));
            header('location:/categories');
        }
    }

}