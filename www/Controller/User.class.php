<?php

namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;

class User{

    public $user;
    
    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function login()
    {
        if( !empty($_POST)){
            $result = Validator::run($this->user->getFormLogin(), $_POST);
            print_r($result);
        }
        $view = new View("login");
        $view->assign("user",$this->user);
    }

    public function logout()
    {
        echo "Se deco";
    }

    public function register()
    {
        if( !empty($_POST)){
            $result = Validator::run($this->user->getFormRegister(), $_POST);
            if(empty($result)){
                $this->user->setFirstname($_POST['firstname']);
                $this->user->setLastname($_POST['lastname']);
                $this->user->setPassword($_POST['password']);
                $this->user->setEmail($_POST['email']);
                $this->user->save();
            }else{
                print_r($result);
            }
        }
        $view = new View("register");
        $view->assign("user",$this->user);
    }


}