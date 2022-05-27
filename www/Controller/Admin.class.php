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

        $sql ="SELECT * FROM cmspf_Users";
        $params = [];
        $res = $this->tableUsers->selectAllUsers($sql, $params);
        
        $view = new View("userManagement");
        $view->assign("tableUsers",$this->tableUsers);
        $view->assign("users", $res);
    }
}