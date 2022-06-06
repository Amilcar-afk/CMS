<?php


namespace App\Controller;


use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Core\CheckInputs;
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
        $view = new View("register", "back-sandbox");
        $view->assign("user",$this->user);
    }
}