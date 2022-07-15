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
            $subject = "Registration confirmation";
            $message = [
                [
                    "type"=>'title',
                    "content"=>'Registration confirmation'
                ],
                [
                    "type"=>'text',
                    "content"=>"Welcome " . $name . ". To confirm your email address"
                ],
                [
                    "type"=>'button',
                    "link"=>$uri,
                    "content"=>'Click here'
                ]
            ];
            $this->mail->sendEmail($mailAddress, $name, $subject, $message);
        }
    }

    public function resetPwdMail($mailAddress, $name, $token)
    {
        $uri = $_SERVER["HTTP_HOST"] . "/resetpassword/?token=" . $token;
        if ($token){
            $message = [
                [
                    "type"=>'title',
                    "content"=>'Reset Password'
                ],
                [
                    "type"=>'text',
                    "content"=>"Hello " . $name . " to reset your password"
                ],
                [
                    "type"=>'button',
                    "link"=>$uri,
                    "content"=>'Click here'
                ]
            ];
            $subject = "Reset Password";
            $this->mail->sendEmail($mailAddress, $name, $subject, $message);
        }
    }

    public function userMailconfirmReservation($dataofMail)
    {

        $subject = "Confirmation of appointment";

        $message = [
            [
                "type"=>'title',
                "content"=>'Confirmation of appointment'
            ],
            [
                "type"=>'text',
                "content"=>"Hello " . $dataofMail['firstname']. ","
            ],
            [
                "type"=>'text',
                "content"=>" Your appointemnent with ". $dataofMail['owner_firstname'] . " " . $dataofMail['title'] ."  <b>".$dataofMail['start'] ." - ".$dataofMail['end'] . '</b>  at ' .$dataofMail['location']
            ],
            [
                "type"=>'text',
                "content"=> $dataofMail['description']
            ],
            [
                "type"=>'text',
                "content"=> "A email has been send to ".$dataofMail['owner_firstname'].  ' ' . $dataofMail['owner_lastname']. " to inform him."
            ]
        ];

        $this->mail->sendEmail($dataofMail['email'], $dataofMail['firstname'], $subject, $message);
    }
    
    public function ownerMailConfirmReservation($dataofMail){
        $subject = "Confirmation of appointment";

        $message = [
            [
                "type"=>'title',
                "content"=>'Confirmation of appointment'
            ],
            [
                "type"=>'text',
                "content"=>"Hello " . $dataofMail['owner_firstname']. ","
            ],
            [
                "type"=>'text',
                "content"=>" Your appointemnent with ". $dataofMail['firstname'] . " " . $dataofMail['title'] ."  <b>".$dataofMail['start'] ." - ".$dataofMail['end'] . '</b>  at ' .$dataofMail['location']
            ],
            [
                "type"=>'text',
                "content"=> $dataofMail['description']
            ],
            [
                "type"=>'text',
                "content"=> "A email has been send to ".$dataofMail['firstname'].  " to inform him."
            ]
        ];

        $this->mail->sendEmail($dataofMail['owner_email'], $dataofMail['owner_firstname'], $subject, $message);
            
            
    }

    public function confirmUserInProject($mailAddress, $name, $id)
    {
        $uri = $_SERVER["HTTP_HOST"] . "/steps/" . $id;

        if ($id){
            $subject = "Registration confirmation";
            $message = [
                [
                    "type"=>'title',
                    "content"=>'You have been added to a project'
                ],
                [
                    "type"=>'text',
                    "content"=>"hey " . $name . ". you are part of a new project "
                ],
                [
                    "type"=>'button',
                    "link"=>$uri,
                    "content"=>'See project'
                ]
            ];
            $this->mail->sendEmail($mailAddress, $name, $subject, $message);
        }
    }



}