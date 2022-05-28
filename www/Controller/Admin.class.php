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
<<<<<<< HEAD
=======
        $this->authAdmin = new Middleware();
>>>>>>> f769d37374770d35cad22b3e11e6dcacf71807f3
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
        $params = [];
        $res = $this->tableUsers->selectAllUsers($sql, $params);
        
        $view = new View("userManagement");
        $view->assign("tableUsers",$this->tableUsers);
        $view->assign("users", $res);
    }
}