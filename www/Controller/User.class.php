<?php

namespace App\Controller;

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
            $result = Validator::checkEmail($_POST['email']);
            if($result){
                $resultat = $this->user->find($_POST['email'],'mail');
                if(!empty($resultat)){
                    if(password_verify($_POST['password'], $resultat->getPassword())){
                        session_start();
                        $_SESSION['Auth'] = $resultat;
                        header('location:/dashboard');
                    }else{
                        echo'mot de passe incorrect';
                    }
                }else{
                    echo'email ou mot passe incorrect';
                }
            }else{
                echo'email incorrect';
            }
        }
        $view = new View("login", "back-sandbox");
        $view->assign("user",$this->user);
    }


    public function logout()
    {
        session_destroy();
        echo "Se deco";
    }


    public function register()
    {
        $view = new View("register", "back-sandbox");
        $view->assign("user",$this->user);
        if( !empty($_POST)){
            $result = Validator::run($this->user->getFormRegister(), $_POST);

            if(empty($result)){
                $this->user->setFirstname($_POST['firstname']);
                $this->user->setLastname($_POST['lastname']);
                $this->user->setPassword($_POST['password']);
                $this->user->setEmail($_POST['email']);
                $this->user->save();
            }
            // else{
            //     var_dump($result);
            // }
        }
    }
}