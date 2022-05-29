<?php

namespace App\Controller;

use App\Core\View;

use App\Core\BaseSQL;
use App\Model\Table as TableModel;
use PDO;
use App\Model\Stats as Stats;

class Admin
{
    public $tableUsers;


    public function __construct()
    {

    }


    public function dashboard()
    {
        $view = new View("dashboard", "back");

        include 'integration/dashboard.html';

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