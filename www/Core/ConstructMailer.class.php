<?php
//C:\Users\AmilcarFernandes\Desktop\esgi\PA\CMS\www\vendor\phpmailer\phpmailer\src\Exception.php
namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once('vendor/phpmailer/phpmailer/src/SMTP.php');
require_once('vendor/phpmailer/phpmailer/src/Exception.php');
require_once('vendor/autoload.php');

class ConstructMailer extends PHPMailer 
{
    public function sendEmail($from_email, $from_name, $to_email, $to_name, $subject, $body)
    {
        $mail = new PHPMailer(TRUE);
        try {
            $mail->setFrom($from_email, $from_name);
            $mail->addAddress($to_email, $to_name);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'fernandesamilcar28@gmail.com';
            $mail->Password = 'lkgrmrlgeffvqoqt';
            $mail->Port = 587;
            
            $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            return $mail->send();

        }catch (Exception $e){
            echo $e->errorMessage();
        }
        catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    /*private $_host = 'smtp.gmail.com';
    private $_user = 'fernandesamilcar28@gmail.com';
    private $_password = 'lkgrmrlgeffvqoqt';

    public function __construct($exceptions=true)
    {
        $this->isSMTP();
        $this->SMTPDebug = TRUE;
        $this->Host = $this->_host;
        $this->Port = 587;
        $this->Username = $this->_user;
        $this->Password = $this->_password;
        $this->SMTPAuth = true;
        $this->SMTPSecure = "tls"; 

        parent::__construct($exceptions);
    }

    //   send security code email
    public function sendSecurityCodeEmail($email, $name, $code)
    {
        $mail_subject = "Security code account";
        $html_body = "toto";
        $mail_body = " Hey here is a test email and security code is: ". $code;
        $email_sent = self::sendEmail($email, $name, $mail_subject, $html_body, $mail_body);
        return $email_sent;
    }

   
    public static function sendEmail($to_email, $to_name, $subject, $html_body, $email_body)
    {   
        $mail_sent = false;
        try{
            $mail = new PHPMailer(TRUE);
            $mail->setFrom("fernandesamilcar28@gmail.com", "Example");
            $mail->addAddress($to_email, $to_name);
            
            $mail->Subject = $subject;
            
            if(!empty($html_body)) {
                $mail->isHTML(true);
                $mail->AltBody = $email_body;
                $mail->Body = $html_body;
            } else
                $mail->Body = $email_body;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            if($mail->send()) $mail_sent = true;
        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return $mail_sent;
    }*/

}