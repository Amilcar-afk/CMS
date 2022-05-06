<?php


namespace App\Controller;


class PageEngine
{
    public $user;
    public function __construct()
    {
        $this->user = new PageModel();
    }


    public function savePage()
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
        $view = new View("login", "back");
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
        $e = 1;
        $view = new View("register");
        $view->assign("user",$this->user);
    }
}