<?php

namespace App\Controller;

use App\Core\View;

class Admin
{

    public function __construct()
    {
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
}