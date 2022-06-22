<?php

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Controller\Mail;
use App\Core\Query;

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
                //$user = $this->user->find($this->user->getMail(), "mail");
                $user = Query::from('cmspf_Users')
                    ->where("mail = '" . $this->user->getMail() . "' AND (deleted IS NULL OR deleted = 0)")
                    ->execute("User");
                if(!empty($user)){
                    if(password_verify($_POST['password'], $user[0]->getPwd())){
                        session_start();
                        $_SESSION['Auth']->mail = $user[0]->getMail();
                        $_SESSION['Auth']->lastname = $user[0]->getLastname();
                        $_SESSION['Auth']->firstname = $user[0]->getFirstname();
                        $_SESSION['Auth']->id = $user[0]->getId();
                        $_SESSION['Auth']->token = $user[0]->getToken();
                        $_SESSION['Auth']->creationDate = $user[0]->getCreationDate();
                        $_SESSION['Auth']->updateDate = $user[0]->getUpdateDate();
                        $_SESSION['Auth']->rank = $user[0]->getRank();
                        if(!isset($_SESSION['redirect_url'])){
                            header('location:/dashboard');
                        }else{
                            header('location:'.$_SESSION['redirect_url']);
                        }
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


            $unic_email = Query::from('cmspf_Users')
                            ->where("mail = '" . $_POST['email'] . "' AND (deleted IS NULL OR deleted = 0)")
                            ->execute("User");
            //$unic_email = $this->user->find($_POST['email'],'mail');

            if(!count($unic_email) > 0)
                $result = Validator::run($this->user->getFormRegister(), $_POST,false);
            else
                $result = Validator::run($this->user->getFormRegister(), $_POST,$unic_email);
            
            if(empty($result)){
                //generate confirmKey
                $this->user->generateToken();
                $confirmKey = $this->user->getToken();
                $confirmKey .= $_POST['email'];
                $this->user->setConfirmKey($confirmKey);

                $mail = new Mail();
                $mail->confirmMail($_POST['email'], $_POST['firstname'], $confirmKey);
                $this->user->save();
            }
            else{
                $view->assign("error_from",$result);
            }
        }
    }

    public function deleteUser()
    {
        if(!empty($_GET['id'])){
            $this->user->setDeleted(1);
            $this->user->setId($_GET['id']);
            $this->user->save();
            echo "user deleted successfully";
        }else{
            echo "user not deleted";
        }
    }

    public function updateRank()
    {
        if(!empty($_POST['id'])){
            $infos = Query::from('cmspf_Users')->where("id=" . $_POST['id'])->execute("User");
            $rank = $infos[0]->getRank();

            if($rank === "admin" || empty($rank))
                $this->user->setRank("user");
            else
                $this->user->setRank("admin");

            $this->user->setId($_POST['id']);
            $this->user->save();
            echo "rank updated";

        }else{
            echo "error in update";
        }
    }

    public function confirmMail()
    {

        $userExist = $this->user->find($_GET['token'], "confirmKey");

        if((!empty($userExist) || $userExist != false) && $userExist->getConfirm() != "1"){

            $this->user->setId($userExist->getId());
            $this->user->setConfirm(1);
            $this->user->save();
            header('location:/login');

        }else{
            http_response_code(400);
        }

    }

    public function pwdReset()
    {
        //echo 'hello';
        $view = new View("form-forgot-pwd", "back-sandbox");
        $view->assign("user", $this->user);
    }

}