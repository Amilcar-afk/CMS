<?php

namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\View;
use App\Model\User as UserModel;

class User{

    public function login()
    {
        $view = new View("Login");
        $view->assign("titleSeo","Se connecter au site");
    }

    public function logout()
    {
        echo "Se deco";
    }

    public function register()
    {

        $user = new UserModel();
        $user->setId(3);
        print_r($user);

        //$user->setEmail("toto@gmail.com");
        //$user->save();

        $view = new View("register");
    }

}