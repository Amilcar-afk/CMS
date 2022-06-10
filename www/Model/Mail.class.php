<?php
namespace App\Model;

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Core\BaseSQL;

require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once('vendor/phpmailer/phpmailer/src/SMTP.php');
require_once('vendor/phpmailer/phpmailer/src/Exception.php');
require_once('vendor/autoload.php');

class Mail extends BaseSQL
{
    protected $token;
    protected $mail;
    protected $id = null;

    public function __construct()
    {
        $this->mail = new PHPMailer(TRUE);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = TRUE;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Username = MAILADDR;
        $this->mail->Password = MAILPWD;
        $this->mail->Port = 587;

        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->mail->setFrom($this->mail->Username, "CMS PORTFOLIO");
    }

    public function sendEmail($to_email, $to_name, $subject, $body)
    {
        try {
            $this->mail->addAddress($to_email, $to_name);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            return $this->mail->send();

        }catch (Exception $e){
            echo $e->errorMessage();
        }
        catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function confirmMail($mailAddress, $name, $id)
    {
        $this->generateToken();
        $token = $this->getToken() . $mailAddress;
        $this->id = $id;

        if ($token){
            $subject = "Confirmation d'inscription";
            $message = "Bienvenue chez nous " . $name . ". Pour confirmer votre adresse mail <a href='www.google.com '>cliquez ici</a>.";
            $this->sendEmail($mailAddress, $name, $subject, $message);
        }
    }

    public function generateToken(): void
    {
        $this->token = str_shuffle(md5(uniqid()));
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}