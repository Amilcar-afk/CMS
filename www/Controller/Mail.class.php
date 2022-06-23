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

    public function confirmReservation($dataofMail)
    {
            $subject = "Confirmation de reservation";
            $message = //
            "Bonjour " . $dataofMail['firstname']. ", le rendez-vous ".$dataofMail['title'] ." de ".$dataofMail['start'] ." a ".$dataofMail['end'] . ' à ' .$dataofMail['location']
            . " et qui a comme description ".$dataofMail['description']. " avec ".
             $dataofMail['owner_firstname'] .  '  ' . $dataofMail['owner_lastname']. ", est confirmé";
             $this->mail->sendEmail($dataofMail['email'], $dataofMail['firstname'], $subject, $message);
    }
    
    public function ownerMailConfirmReservation($dataofMail){
        $subject = "Confirmation de reservation";
        $ownerMessage = 
        "Bonjour " . $dataofMail['owner_firstname'].  ' ' . $dataofMail['owner_lastname'].  ". Votre rendez-vous ".$dataofMail['title'] ." de ".$dataofMail['start'] ." a ".$dataofMail['end']
        . ' à ' .$dataofMail['location']
        . " et qui a comme description ".$dataofMail['description'] ." a été choisie par ". $dataofMail['firstname']. ' ' .$dataofMail['lastname'];
        $this->mail->sendEmail($dataofMail['owner_email'], $dataofMail['owner_firstname'], $subject, $ownerMessage);

            
            
    }

}