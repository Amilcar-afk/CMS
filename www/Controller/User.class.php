<?php


namespace App\Controller;


use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Core\CheckInputs;
use App\Model\User as UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class User{

    public $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }

    // public function mailConfirmation(){

    //     $mail = new PHPMailer(true);
    //         try {
    //         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    //         $mail->isSMTP();                                           
    //         $mail->Host       = 'smtp.gmail.com';                  
    //         $mail->SMTPAuth   = true;                                 
    //         $mail->Username   = 'marwane.berkani@gmail.com';                 
    //         $mail->Password   = 'marwaneberkani';                               
    //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    //         $mail->Port       = 587;                                    
            
    //         $mail->setFrom('marwane.berkani@gmail.com', 'URBAN SOCCER');
    //         $mail->addAddress('marwane.berkani@gmail.com', 'Mr/Mme');     
            
            
    //         $mail->isHTML(true);                                  
    //         $mail->Subject = 'Reservation';
    //         $mail->Body    = "<p>nous vous Remercions pour votre Reservation a tres bientot !</p>  </div>";
            
    //         $mail->send();
    //         echo 'Message has been sent';
    //         } catch (Exception $e) {
    //             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    //         }
    // }

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
        $view = new View("login", "back");
        $view->assign("user",$this->user);
    }

    public function usersList()
    {
        $usersLIst =  $this->user->findAllData($sql = "SELECT * FROM cmsp_user");
        $view = new View("userslist",'back');
        $view->assign("user",$this->user);
        $view->assign("usersLIst", $usersLIst);

    }

    public function deleteUser()
    {
        
        var_dump($_GET);
        // $id = $_GET['id'];
        // $this->user->findAllData($sql = "DELETE FROM cmsp_user WHERE id = :id", $id);
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