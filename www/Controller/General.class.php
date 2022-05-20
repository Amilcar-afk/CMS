<?php

namespace App\Controller;
use App\Controller\Authadmin;

use App\Core\View;

class General{

    public $authAdmin ;

    public function __construct()
    {
        $this->authAdmin = new Authadmin();
        Authadmin::isLogged();
    }

    public function home()
    {
        echo "Welcome";
    }

    public function contact()
    {
        $view = new View("contact");
    }

    public function integration()
    {
        // $view = new View("integration");
        include 'integration/index.html';
    }
}


