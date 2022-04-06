<?php

namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Core\CheckInputs;
use App\Core\ConstructMailer;

use App\Model\User as UserModel;

class User{

    public $user;
    public $mailer;
    
    public function __construct()
    {
        $this->user = new UserModel();
        $this->mailer = new ConstructMailer();
    }

    public function login()
    {

        // APPEL LES VERIFS
        if( !empty($_POST)){
            $result = CheckInputs::checkEmail($_POST['email']);
            $sql ="SELECT try FROM cmsp_user WHERE email =:email";
            $res = $this->user->select($sql,$_POST['email']);
            print_r($res);
        }

        // CREER LA NOUVELLE VIEW
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

    public function sendMail()
    {
        $user_email = "blackoscapos@gmail.com";
        $name = "John Doe";
        $code = "ranD0m";
        $send = $this->mailer->sendEmail("
            fernandesamilcar28@gmail.com", 
            "CMS PORTFOLIO", 
            "blackoscapos@gmail.com", 
            "Chère utilisateur", 
            "Confirmation inscription.", 
            "Bienvenue chez nous."
        );

        if($send) 
            echo("Sent.");
        else 
            echo("Not sent.");
    }   

}