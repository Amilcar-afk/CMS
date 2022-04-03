<?php

namespace App\Controller;

use App\Core\View;
use App\Core\BaseSQL;
use App\Model\Table as TableModel;

class Admin
{
    public $tableUsers;
    
    public function __construct()
    {
        $this->tableUsers = new TableModel();
        $this->authAdmin = new Authadmin();
        Authadmin::isLogged();
    }
    
    public function dashboard()
    {
        $firstname = "Marouane";
        $lastname = "Talbi";

        $view = new View("dashboard", "back");
        $view->assign("firstname", $firstname);
        $view->assign("lastname", $lastname);

    }

    public function userManagement(){

        $sql ="SELECT * FROM cmsp_user";
        $res = $this->tableUsers->selectAllUsers($sql, array());
        print_r($res);

        $view = new View("userManagement");
        $view->assign("tableUsers",$this->tableUsers);
    }
}