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
            $message = "Bienvenue chez nous " . $name . ". Pour confirmer votre adresse mail <a href='" . $uri . "'>cliquez ici</a>.";
            $this->mail->sendEmail($mailAddress, $name, $subject, $message);
        }
    }

}