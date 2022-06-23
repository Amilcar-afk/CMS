<?php

namespace App\Controller;

use App\Model\Mail as MailModel;

class Mail{

    public $mail;

    public function __construct()
    {
        $this->mail = new MailModel();
    }

    public function confirmMail($mailAddress, $name, $token)
    {
        $uri = $_SERVER["HTTP_HOST"] . "/mailconfirmation/?token=" . $token;
        if ($token){
            $subject = "Confirmation d'inscription";
            $message = "Welcome " . $name . ". To confirm your email address <a href='" . $uri . "'>Click here</a>.";
            $this->mail->sendEmail($mailAddress, $name, $subject, $message);
        }
    }

    public function resetPwdMail($mailAddress, $name, $token)
    {
        $uri = $_SERVER["HTTP_HOST"] . "/resetpassword/?token=" . $token;
        if ($token){
            $subject = "Confirmation d'inscription";
            $message = "Hello " . $name . " to reset your password <a href='" . $uri . "'>Click here</a>.";
            $this->mail->sendEmail($mailAddress, $name, $subject, $message);
        }
    }

}