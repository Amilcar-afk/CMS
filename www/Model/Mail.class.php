<?php
namespace App\Model;

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once('vendor/phpmailer/phpmailer/src/SMTP.php');
require_once('vendor/phpmailer/phpmailer/src/Exception.php');
require_once('vendor/autoload.php');

class Mail extends PHPMailer
{
    public function sendEmail($to_email, $to_name, $subject, $body)
    {
        $mail = new PHPMailer(TRUE);
        try {
            $mail->setFrom("fernandesamilcar28@gmail.com", "CMS PORTFOLIO");
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

    public function confirmMail($mailAddress, $name){
        $subject = "Confirmation d'inscription";
        $message = "Bienvenue chez nous " . $name . ". Pour confirmer votre adresse mail cliquez ici.";
        $this->sendEmail($mailAddress, $name, $subject, $message);
    }
}