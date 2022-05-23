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
            $result = CheckInputs::checkEmail($_POST['email']);
            if($result){
                $this->user->setEmail($_POST['email']);
                $sql = "SELECT * FROM cmsp_user WHERE email = :email";
                $resultat = $this->user->select($sql,['email'=>$this->user->getEmail()] );
                if(!empty($resultat)){
                    if(password_verify($_POST['password'], $resultat->password)){
                        echo'Bienvenu ! fdp';
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

        // CREER LA NOUVELLE VIEW
        $view = new View("login", "back-sandbox");
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
        $view = new View("register", "back-sandbox");
        $view->assign("user",$this->user);
    }












   
}