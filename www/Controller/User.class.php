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
                                http_response_code(308);
                            }
                        }else{

                            header('location:'.$_SESSION['redirect_url']);
                            http_response_code(308);
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


        if( !empty($_POST)){
            $date = date("Y-m-d");
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

                    $view = new View("message", 'back-sandbox');
                    $view->assign("metaData", $metaData = [
                        "title" => 'Account successfully created',
                        "description" => 'Account successfully created.',
                    ]);
                    $view->assign("message", "Your account has been successfully created. You will recive a email to confirm this account.");
                }
            }else{
                $view = new View("register", "back-sandbox");
                $view->assign("metaData", $metaData = [
                    "title" => 'Register',
                    "description" => 'Register page'
                ]);
                $view->assign("user",$this->user);
                $view->assign("error_from",$result);
                http_response_code(422);
            }
        }else{
            $view = new View("register", "back-sandbox");
            $view->assign("metaData", $metaData = [
                "title" => 'Register',
                "description" => 'Register page'
            ]);
            $view->assign("user",$this->user);
        }
    }

    public function deleteUser()
    {
        if(!empty($_GET['id'])){
            $this->user->setDeleted(1);
            $this->user->setId($_GET['id']);
            $this->user->save();
            echo "User deleted successfully";
            http_response_code(202);
        }else{
            echo "User not deleted";
            http_response_code(304);
        }
    }

    public function updateRank()
    {
        if(isset($_POST['id']) && isset($_POST['rank']) && ($_POST['rank'] == 'admin' || $_POST['rank'] == 'user')){
            $this->user = $this->user->find($_POST['id']);

            if($this->user->getId() != null){
                $this->user->setRank($_POST['rank']);
                $this->user->save();
                echo "Rank updated";
                http_response_code(201);
            }else{
                echo "Error in update";
                http_response_code(304);
            }
        }else{
            echo "Error in update";
            http_response_code(304);
        }
    }

    public function confirmMail()
    {
        $userExist = $this->user->find($_GET['token'], "confirmKey");

        if((!empty($userExist) || $userExist != false) && $userExist->getConfirm() != "1"){

            $this->user->setId($userExist->getId());
            $this->user->setConfirm(1);
            $this->user->save();
            $view = new View("message", 'back-sandbox');
            $view->assign("metaData", $metaData = [
                "title" => 'Account confirmed',
                "description" => 'Your account has been verified.',
            ]);
            $view->assign("message", "Your account has been verified. You can now connect.");

        }else{
            http_response_code(400);
        }

    }

    public function pwdReset()
    {

        if(!empty($_POST)){

            $user = Query::from('cmspf_Users')
                ->where("mail = :mail AND (deleted IS NULL OR deleted = 0)")
                ->params([
                    'mail' => $_POST['email']
                ])
                ->execute("User");

            if(!empty($user)){

                $this->user->generateToken();
                $token = $this->user->getToken();
                $this->user->setId($user[0]->getId());
                $this->user->save();

                $mail = new Mail();
                $mail->resetPwdMail($_POST['email'], '', $token);

            }

            $view = new View("message", 'back-sandbox');
            $view->assign("metaData", $metaData = [
                "title" => 'Changed password',
                "description" => 'Request for password change.',
            ]);
            $view->assign("message", "If the email that you send to us correspond to a account, you will recive a email for reset your password.");

        }else{
            $view = new View("form-forgot-pwd", "back-sandbox");
            $view->assign("metaData", $metaData = [
                "title" => 'Forgot password',
                "description" => 'Forgot password page'
            ]);

            $view->assign("user", $this->user);
        }

    }

    public function newPwd()
    {
        $user = $this->user->find($_GET['token'], "token");

        if((!empty($user) || $user != false) && $user->getConfirm() == "1") {

            if (!empty($_POST)) {
                $this->user->setPassword($_POST['password']);

                $result = Validator::run($this->user->getFormNewPwd(), $_POST);

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
                    $view = new View("message", 'back-sandbox');
                    $view->assign("metaData", $metaData = [
                        "title" => 'Changed password',
                        "description" => 'Your password has been changed.',
                    ]);
                    $view->assign("message", "Your password has been changed. You can now connect.");

                }else{
                    http_response_code(422);
                }
            }else{
                $view = new View("form-forgot-pwd", "back-sandbox");
                $view->assign("metaData", $metaData = [
                    "title" => 'Change password',
                    "description" => 'Change password page'
                ]);
                $view->assign("user", $this->user);
                $view->assign("resetPwd", $this->user);
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
                echo '<i><p class="title title--small">No step</p></i>';
            }
        }

    }

}