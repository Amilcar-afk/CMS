<?php

namespace App\Controller;

use App\Core\View;
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
        //$view = new View();
        //$message = $view->includePartial("mail", $pageEmpty->getFormNewPage($categories)); //ajouter le tableau en param
        $uri = $_SERVER["HTTP_HOST"] . "/resetpassword/?token=" . $token;
        if ($token){
            $subject = "Confirmation d'inscription";
            $message = "Hello " . $name . " to reset your password <a href='" . $uri . "'>Click here</a>.";
            $this->mail->sendEmail($mailAddress, $name, $subject, $message);
        }
    }

    public function userMailconfirmReservation($dataofMail)
    {

        $subject = "Confirmation de reservation";
        $message = 
        "Bonjour " . $dataofMail['firstname']. ", le rendez-vous ".$dataofMail['title'] ." de ".$dataofMail['start'] ." a ".$dataofMail['end'] . ' à ' .$dataofMail['location']
        . " et qui a comme description ".$dataofMail['description']. " avec ".
        $dataofMail['owner_firstname'] .  '  ' . $dataofMail['owner_lastname']. ", est confirmé. un email a été envoyé à ".$dataofMail['owner_firstname'].  ' ' . $dataofMail['owner_lastname'].
        " pour l'informer sur votre rendez-vous." ;

        $this->mail->sendEmail($dataofMail['email'], $dataofMail['firstname'], $subject, $message);
    }
    
    public function ownerMailConfirmReservation($dataofMail){
        $subject = "Confirmation de reservation";
        $ownerMessage = 
        "Bonjour " . $dataofMail['owner_firstname'].  ' ' . $dataofMail['owner_lastname'].  ". Votre rendez-vous ".$dataofMail['title'] ." de ".$dataofMail['start'] ." a ".$dataofMail['end']
        . ' à ' .$dataofMail['location']
        . " et qui a comme description : ".$dataofMail['description'] .", a été choisie par ". $dataofMail['firstname']. ' ' 
        .$dataofMail['lastname']. ' vous pouvez le contavtez via son email: '.$dataofMail['email'];


        $this->mail->sendEmail($dataofMail['owner_email'], $dataofMail['owner_firstname'], $subject, $ownerMessage);

            
            
    }

}