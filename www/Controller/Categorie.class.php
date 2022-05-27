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

            if(isset($_POST['type'])){
                $this->categorie->setType('nav');
                $this->categorie->save();
                // $lastId = $this->categorie->getLastId();
            }else{
                echo 'Nok';
            }
        }
        $view = new View("categorieinsert", "back-sandbox");
        $view->assign("categorie",$this->categorie);
    }

    public function categoriesUpdate()
    {
        if(isset($_POST['id']))
        {
            $this->categorie->setId($_POST['id']);
            $this->categorie->setType($_POST['type']);
            $this->rdv->save();
        }
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