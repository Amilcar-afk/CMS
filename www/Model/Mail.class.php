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
}