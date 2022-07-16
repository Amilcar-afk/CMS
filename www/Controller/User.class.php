<?php

namespace App\Controller;

use App\Controller\Mail;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Core\Query;

class User{

    public $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function login()
    {
        if(!empty($_SESSION)){
            session_destroy();
        }
        
        $view = new View("login", "back-sandbox");
        $view->assign("metaData", $metaData = [
            "title" => 'Login',
            "description" => 'Login'
        ]);
        $view->assign("user",$this->user);
        
        
        if( !empty($_POST)){
            $result = Validator::checkEmail($_POST['email']);
            
            if($result){
                $this->user->setMail($_POST['email']);
                $user = Query::from('cmspf_Users')
                ->where("mail = :mail AND (deleted IS NULL OR deleted = 0) AND confirm = 1")
                ->params(['mail'=> $this->user->getMail()])
                ->execute("User");
                
                
                if(empty($user)){
                    $loginAuth = [
                        'email' => false,
                        'pass' => false
                    ];
                
                }else if($user[0]->getMail() != null && password_verify($_POST['password'], $user[0]->getPwd()) === false){
                    $loginAuth = [
                        'email' => $user[0]->getMail(),
                        'pass' => false
                    ];

                }else{
                    $loginAuth = [
                        'email' => $user[0]->getMail(),
                        'pass' => $user[0]->getPwd()
                    ];
                }

                $config = Validator::run($this->user->getFormLogin(),$_POST,false,$loginAuth );

                
                if(empty($config)){
                    session_start();
                    $user[0]->generateToken();
                    $user[0]->save();
                    $_SESSION['Auth']->mail = $user[0]->getMail();
                    $_SESSION['Auth']->lastname = $user[0]->getLastname();
                    $_SESSION['Auth']->firstname = $user[0]->getFirstname();
                    $_SESSION['Auth']->id = $user[0]->getId();
                    $_SESSION['Auth']->token = $user[0]->getToken();
                    $_SESSION['Auth']->updateDate = $user[0]->getUpdateDate();
                    $_SESSION['Auth']->rank = $user[0]->getRank();
// <<<<<<< HEAD
//                     if(!isset($_SESSION['redirect_url'])){
//                         header('location:/dashboard');
//                     }else{
//                         header('location:'.$_SESSION['redirect_url']);
// =======

                    $users = Query::from('cmspf_Users')
                        ->execute("User");

                    if (sizeof($users) == 1){
                        header('location:/setup/smtp');
                    }else{
                        if(!isset($_SESSION['redirect_url'])){
                            if ($user[0]->getRank() == 'admin') {
                                header('location:/dashboard');
                            }else{
                                header('location:/');
                            }
                        }else{

                            header('location:'.$_SESSION['redirect_url']);
                        }
                    }
                }else{

                    $view->assign("error_loginFrom",$config);
                }
            }
        }
    }


    public function logout()
    {
        session_destroy();
        header('location:/login');
    }



    public function register()
    {
        $view = new View("register", "back-sandbox");
        $view->assign("metaData", $metaData = [
            "title" => 'Register',
            "description" => 'Register page'
        ]);
        $view->assign("user",$this->user);
        $date = date("Y-m-d");
        if( !empty($_POST)){
            $this->user->setFirstname($_POST['firstname']);
            $this->user->setLastname($_POST['lastname']);
            $this->user->setPassword($_POST['password']);
            $this->user->setMail($_POST['email']);
            $this->user->setRank('user');
            $this->user->setDateCreation($date);
            $this->user->generateToken();

            $users = Query::from('cmspf_Users')
                ->execute("User");

            if (sizeof($users) == 0){
                $this->user->setRank('admin');
                $this->user->setConfirm(1);
            }

            $unic_email = Query::from('cmspf_Users')
                            ->where("mail = '" . $_POST['email'] . "' AND (deleted IS NULL OR deleted = 0)")
                            ->execute("User");

            if(!count($unic_email) > 0)
                $result = Validator::run($this->user->getFormRegister(), $_POST,false);
            else
                $result = Validator::run($this->user->getFormRegister(), $_POST,$unic_email);
            
            if(empty($result)){
                //generate confirmKey
                $this->user->generateConfirmKey($_POST['email']);
                $this->user->save();

                if (sizeof($users) == 0){
                    header('location:/setup/login');
                }else{

                    $confirmKey = $this->user->getConfirmKey();
                    $mail = new Mail();
                    $mail->confirmMail($_POST['email'], $_POST['firstname'], $confirmKey);
                }
            }else{
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
            echo "User deleted successfully";
        }else{
            echo "User not deleted";
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
            echo "Rank updated";

        }else{
            echo "Error in update";
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

        $view = new View("form-forgot-pwd", "back-sandbox");
        $view->assign("metaData", $metaData = [
            "title" => 'Forgot password',
            "description" => 'Forgot password page'
        ]);

        $view->assign("user", $this->user);

        if(!empty($_POST)){

            $user = Query::from('cmspf_Users')
                ->where("mail = '" . $_POST['email'] . "' AND (deleted IS NULL OR deleted = 0)")
                ->execute("User");

            if(!empty($user)){

                $this->user->generateToken();
                $token = $this->user->getToken();
                $this->user->setId($user[0]->getId());
                $this->user->save();

                $mail = new Mail();
                $mail->resetPwdMail($_POST['email'], '', $token);

            }
        }

    }

    public function newPwd()
    {
        $user = $this->user->find($_GET['token'], "token");

        if((!empty($user) || $user != false) && $user->getConfirm() == "1") {

            $view = new View("form-forgot-pwd", "back-sandbox");
            $view->assign("metaData", $metaData = [
                "title" => 'Change password',
                "description" => 'Change password page'
            ]);
            $view->assign("user", $this->user);
            $view->assign("resetPwd", $this->user);

            if (!empty($_POST)) {
                $this->user->setPassword($_POST['password']);

                if (!count($user) > 0)
                    $result = Validator::run($this->user->getFormNewPwd(), $_POST, false);
                else
                    $result = Validator::run($this->user->getFormNewPwd(), $_POST, $user);

                if (empty($result)) {

                    $pwd1 = $user->getPwd1();
                    $pwd = $user->getPwd();
                    $userId = $user->getId();
                    $this->user->generateToken();

                    $this->user->setPassword($_POST['password']);
                    $this->user->setPwd1($pwd);
                    $this->user->setPwd2($pwd1);
                    $this->user->setId($userId);
                    $this->user->save();
                    header('location:/login');

                }
            }

        } else {
            http_response_code(400);
        }
    }

    public function findUsers()
    {
        if (!empty($_GET)) {
            $users = Query::from('cmspf_Users')
                ->or("firstname LIKE '%" . $_GET['str'] . "%'")
                ->or("lastname LIKE '%" . $_GET['str'] . "%'")
                ->or("mail LIKE '%" . $_GET['str'] . "%'")
                ->execute("User");
            if(!empty($users)){
                echo "<ul>";
                foreach ($users as $user){
                    echo "<li>" . $user->getLastname() . " " . $user->getFirstname() . "</li>";
                }
                echo "</ul>";
            }else{
                echo '<i>No user</i>';
            }
        }

    }

}