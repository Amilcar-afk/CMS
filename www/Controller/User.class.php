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

                $this->user->setMail($_POST['email']);
                $user = $this->user->find($this->user->getMail(), "mail");
                if(!empty($user)){
                    if(password_verify($_POST['password'], $user->getPwd())){
                        session_start();
                        $_SESSION['Auth']->mail = $user->getMail();
                        $_SESSION['Auth']->lastname = $user->getLastname();
                        $_SESSION['Auth']->firstname = $user->getFirstname();
                        $_SESSION['Auth']->id = $user->getId();
                        $_SESSION['Auth']->token = $user->getToken();
                        $_SESSION['Auth']->creationDate = $user->getCreationDate();
                        $_SESSION['Auth']->updateDate = $user->getUpdateDate();
                        $_SESSION['Auth']->rank = $user->getRank();
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
            $this->user->setFirstname($_POST['firstname']);
            $this->user->setLastname($_POST['lastname']);
            $this->user->setPassword($_POST['password']);
            $this->user->setMail($_POST['email']);

            $unic_email = $this->user->find($_POST['email'],'mail');
            $result = Validator::run($this->user->getFormRegister(), $_POST,$unic_email);
            
            if(empty($result)){
                $this->user->save();
            }
            else{
                $view->assign("error_from",$result);
            }
        }
    }
}