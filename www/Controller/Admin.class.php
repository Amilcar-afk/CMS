<?php

namespace App\Controller;

use App\Core\View;
use PDO;
use App\Model\Stats as Stats;

class Admin
{

    // public function __construct()
    // {
    //     $this->authAdmin = new Authadmin();
    //     Authadmin::isLogged();
    // }
    

    public function dashboard()
    {
        $view = new View("dashboard", "back");

        include 'integration/dashboard.html';

    }

    
}