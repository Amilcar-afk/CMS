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
        $sql = "SELECT * FROM cmspf_Categories";
        $allCategories = $this->categorie->getAllCategories($sql);
        $view = new View("categorielist", "back-sandbox");
        $view->assign("categories",$allCategories);
    }

    public function composeCategorie()
    {
        if(isset($_POST['id']))
        {
            $this->categorie->setId($_POST['id']);
            $this->categorie->setType($_POST['type']);
            echo 'id existe';
            $this->categorie->save();
        }else{
            echo 'id existe pas';
            var_dump($_POST);
            if(isset($_POST['type'])){
                $this->categorie->setType($_POST['type']);
                $this->categorie->save();
            }else{
                echo 'Nok';
            }
        }
        $view = new View("categorieinsert", "back-sandbox");
        $view->assign("categorie",$this->categorie);
    }

    public function categoriesDelete()
    {

        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $this->categorie->deleteCategorie($this->rdv->setId($id));
        }

    }

}