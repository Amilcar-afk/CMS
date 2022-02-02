<?php

namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;

class User{

    public function login()
    {

        // if( !empty($_POST)){
        //     $result = Validator::run($user->getFormLogin(), $_POST);
        //     print_r($result);
        // }
        // $view = new View("login");
        // $view->assign("titleSeo","Se connecter au site");

        $user = new UserModel();
        // var_dump($_POST);
        if( !empty($_POST)){
            $result = Validator::run($user->getFormRegister(), $_POST);
            print_r($result);
        }
        $view = new View("login");
        // $view->assign("user",$user);
        $view->assign("user",$user);

    }

    public function logout()
    {
        echo "Se deco";
    }

    public function register()
    {
        $user = new UserModel();
        // var_dump($_POST);
        if( !empty($_POST)){
            $result = Validator::run($user->getFormRegister(), $_POST);
            print_r($result);
        }
        $view = new View("register");
        $view->assign("user",$user);
    }

}