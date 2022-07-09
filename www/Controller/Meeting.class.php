<?php

namespace App\Controller;

use App\Core\Query;
use App\Core\Validator;
use App\Core\View;
use App\Model\Rdv;
use App\Model\User_rdv;
use App\Controller\Mail; ;


class Meeting
{
    public $rdv;
    public $authAdmin ;
    public $user_rdv;
    public $mail;


    public function __construct()
    {
        $this->rdv = new Rdv();
        $this->user_rdv = new User_rdv();
        $this->mail = new Mail();
    }


    public function loadslot ()
    {
        $statusOfUser = $_SESSION['Auth']->rank;
        $rdvs = $this->rdv->find();
        
        foreach ($rdvs as $row) {
            $users = $row->users();
            foreach($users as $user){
               $owner_email = $user->getMail();
               $owner_firstname = $user->getFirstname();
               $owner_lastname = $user->getLastname();


            }
            if ($row->getStatus() === 'slot') {
                $color = '#32CD32';//GREEN
            } else {
                $color = '#DC143C';//RED
            }
            $allRdvs[] = array(
                "id" => $row->getId(),
                "title" => $row->getTitle(),
                "start" => $row->getStartDate(),
                "end" => $row->getEndDate(),
                "rank" => $statusOfUser,
                "location" => $row->getLocation(),
                "description" => $row->getDescription(),
                "owner_email"=>$owner_email,
                "owner_firstname"=>$owner_firstname,
                "owner_firstname"=>$owner_lastname,
                "status" => $row->getStatus(),
                "color" => $color,
            );
        }
        if (isset($allRdvs)) {
            echo json_encode($allRdvs);
        }
    }

    public function listRdv()
    {
        $rdvEmpty = new Rdv();
        $view = new View("meeting-list", "back");
        $view->assign("rdvEmpty", $rdvEmpty);
        $view->assign("rdv", $this->rdv);
        $view->assign("metaData", $metaData = [
            "title" => 'My Meetings',
            "description" => 'List of all your meetings',
            "src" => [
                ["type" => "js", "path" => "../style/js/calendar.js"],
                ["type" => "css", "path" => "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"],
                ["type" => "js", "path" => "https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js"],
                ["type" => "js", "path" => "https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js"],
                ["type" => "js", "path" => "https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery-ui.min.js"],
                ["type" => "js", "path" => "https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js"],
                ["type" => "js", "path" => "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/af.min.js"],
            ],
        ]);
    }

    public function loadMeetings(){

        $id = $_SESSION['Auth']->id;
        $myMeetings = Query::from('cmspf_User_rdv')->where("user_key=".$id)->execute('Rdv');
        $meetings = [];
        foreach($myMeetings as $e){
            $rdv = $this->rdv->find($e->rdv_key);
            array_push($meetings, $rdv);
        }
        $unicMeeting = array_unique($meetings,SORT_REGULAR);

        foreach($unicMeeting as $row){

            if($row != false){
                if($row->getStatus() == 'slot'){
                    continue;
                    
                }
                $users = $row->users();
                foreach($users as $user){
                    $owner_email = $user->getMail();
                    $owner_firstname = $user->getFirstname();
                    $owner_lastname = $user->getLastname();
                 }

                $allRdvs[] = array(
                    "id" => $row->getId(),
                    "title"=>$row->getTitle(),
                    "start" => $row->getStartDate(),
                    "end" => $row->getEndDate(),
                    "status" => $row->getStatus(),
                    "location" => $row->getLocation(),
                    "owner_email"=>$owner_email,
                    "owner_firstname"=>$owner_firstname,
                    "owner_firstname"=>$owner_lastname,
                    "color" => '#ff7f00',//ORANGE
                );
            }
        }
        if (isset($allRdvs)) {
            echo json_encode($allRdvs);
        }
    }

    public function loadAvailableMeetings(){

        $id = $_SESSION['Auth']->id;
        $myMeetings = Query::from('cmspf_User_rdv')->where("type='owner'")->execute('Rdv');
        $meetings = [];
        foreach($myMeetings as $e){
            $rdv = $this->rdv->find($e->rdv_key);
            array_push($meetings, $rdv);
        }

       
       
        foreach($meetings as $row){
            if($row != false){
                if($row->getStatus() == 'rdv'){
                    continue;
                }
                $users = $row->users();
                foreach($users as $user){
                    $owner = $user->getMail();
                    $owner_firstname = $user->getFirstname();
                    $owner_lastname = $user->getLastname();
                 }
                $allRdvs[] = array(
                    "id" => $row->getId(),
                    "title"=>$row->getTitle(),
                    "start" => $row->getStartDate(),
                    "end" => $row->getEndDate(),
                    "status" => $row->getStatus(),
                    "location" => $row->getLocation(),
                    "owner_email"=>$owner,
                    "owner_firstname"=>$owner_firstname,
                    "owner_lastname"=>$owner_lastname,
                    "name" => $_SESSION['Auth']->firstname,
                    "color" => '#32CD32',
                );
            }
        }
        echo json_encode($allRdvs);
    }


    public function listSlot()
    {
        $view = new View("slot-list", "back");
        $view->assign("metaData", $metaData = [
            "title" => 'Slots',
            "description" => 'List of all slots',
            "src" => [
                ["type" => "js", "path" => "../style/js/calendar.js"],
                ["type" => "css", "path" => "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"],
                ["type" => "js", "path" => "https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js"],
                ["type" => "js", "path" => "https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js"],
                ["type" => "js", "path" => "https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery-ui.min.js"],
                ["type" => "js", "path" => "https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js"],
                ["type" => "js", "path" => "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/af.min.js"],
            ],
        ]);
    }


    public function composeSlot()
    {

        
        if (isset($_POST)) {
            var_dump($_POST);
            //insert pour la table Rdvs
            $this->rdv->setStartDate($_POST['start']);
            $this->rdv->setEndDate($_POST['end']);
            $this->rdv->setStatus('slot');
            $this->rdv->setTitle('Slot');
            $this->rdv->setDescription('defaultDescription');
            $this->rdv->setLocation('defaultLocation');


            if (isset($_POST['id']) && $_POST['id'] != null) {
                if (!$this->rdv->find($_POST['id'])) {
                    return include "View/Partial/form.partial.php";
                }
                $this->rdv->setId($_POST['id']);
                $config = Validator::run($this->rdv->getFormUpdateSlot(), $_POST);
            }else{
                $config = Validator::run($this->rdv->getFormNewSlot(), $_POST);
            }
            if (empty($config)) {
                $this->rdv->save();
                //insert pour la table User_rdv
                $lastId = $this->rdv->getLastId();
                if ($lastId && !isset($_POST['id'])) {
                    $this->user_rdv->setType('owner');
                    $this->user_rdv->setUser_key($_SESSION['Auth']->id);
                    $this->user_rdv->setRdv_key($lastId);
                    $this->user_rdv->save();
                }
            }
        }
    }

    public function deleteRdv()
    {
        if($_POST['id']){
            $this->rdv->setId($_POST['id']);
            $this->rdv->delete($this->rdv->getId());
        }
    }

    public function composeMeeting()
    {
        if (isset($_POST)) {
            $owner_email = $_POST['owner_email'];
            $owner_firstname = $_POST['firstname'];
            $owner_lastname = $_POST['lastname'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];


            unset($_POST['owner_email']);
            unset($_POST['firstname']);
            unset($_POST['lastname']);
            unset($_POST['start_date']);
            unset($_POST['end_date']);



            if (!$this->rdv->find($_POST['id'])) {
                return include "View/Partial/form.partial.php";
            }
            //insert pour la table Rdvs
            $this->rdv->setTitle($_POST['title']);
            $this->rdv->setStatus('rdv');
            $this->rdv->setLocation($_POST['location']);
            $this->rdv->setDescription($_POST['description']);
            $this->rdv->setId($_POST['id']);
            $config = Validator::run($this->rdv->getFormNewMeeting(),$_POST);
            if (empty($config)) {
                $this->rdv->save();

                $dataOfMail= [

                    "owner_firstname"=>$owner_firstname,
                    "owner_lastname"=>$owner_lastname,
                    "owner_email"=>$owner_email,
                    "start"=>$start_date,
                    "end"=>$end_date,
                    "email"=> $_SESSION['Auth']->mail,
                    "firstname"=> $_SESSION['Auth']->firstname,
                    "lastname"=>$_SESSION['Auth']->lastname,
                    "title"=>$_POST['title'],
                    "location"=>$_POST['location'],
                    "description"=>$_POST['description'],
                ];

                $this->mail->userMailconfirmReservation($dataOfMail);
                $mailOwner = new Mail();
                $mailOwner->ownerMailConfirmReservation($dataOfMail);

                //insert pour la table User_rdv
                $lastId = $this->rdv->getLastId();
                if ($lastId) {
                    $this->user_rdv->setType('customer');
                    $this->user_rdv->setUser_key($_SESSION['Auth']->id);
                    $this->user_rdv->setRdv_key($lastId);
                    $this->user_rdv->save();
                    $view = new View("meeting-list");
                    $view->assign("rdv", $this->rdv);
                    $rdvEmpty = new Rdv();
                    $view->assign("rdvEmpty", $rdvEmpty);
                }
            } else {
                return include "View/Partial/form.partial.php";
            }
        }
    }



    
}