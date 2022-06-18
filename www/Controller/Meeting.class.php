<?php

namespace App\Controller;

use App\Core\Query;
use App\Core\Validator;
use App\Core\View;
use App\Model\Rdv;
use App\Model\User_rdv;

class Meeting
{
    public $rdv;
    public $authAdmin ;
    public $user_rdv;

    public function __construct()
    {
        $this->rdv = new Rdv();
        $this->user_rdv = new User_rdv();
    }


    public function load ()
    {
        $statusOfUser = $_SESSION['Auth']->rank;
        $rdvs = $this->rdv->find();
        foreach ($rdvs as $row) {
            // if($statusOfUser != 1 && $row->getStatus() === 'rdv'){
            //     continue;
            // }
            if($row->getStatus() === 'slot'){
                $color = '#32CD32';//GREEN
            }else{
                $color = '#DC143C';//RED
            }
            $allRdvs[] = array(
                "id" => $row->getId(),
                "title"=>$row->getTitle(),
                "rank"=> $statusOfUser,
                "start" => $row->getStartDate(),
                "end" => $row->getEndDate(),
                "status" => $row->getStatus(),
                "color" => $color,
            );
        }
        echo json_encode($allRdvs);
    }


    public function listRdv()
    {
        $rdvEmpty = new Rdv();
        $view = new View("meeting-list", "back");
        $view->assign("rdvEmpty", $rdvEmpty);
        $view->assign("rdv", $this->rdv);

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


                $allRdvs[] = array(
                    "id" => $row->getId(),
                    "title"=>$row->getTitle(),
                    "start" => $row->getStartDate(),
                    "end" => $row->getEndDate(),
                    "status" => $row->getStatus(),
                    "color" => '#ff7f00',//ORANGE
                );
            }
        }



        echo json_encode($allRdvs);
    }

    public function loadAvailableMeetings(){

        $id = $_SESSION['Auth']->id;
        $myMeetings = Query::from('cmspf_User_rdv')->where("user_key=".$id)->execute('Rdv');
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
                $allRdvs[] = array(
                "id" => $row->getId(),
                "title"=>$row->getTitle(),
                "start" => $row->getStartDate(),
                "end" => $row->getEndDate(),
                "status" => $row->getStatus(),
                "color" => '#32CD32',

            );
            }
        }
        echo json_encode($allRdvs);
    }


    public function listSlot()
    {
        $view = new View("slot-list", "back");
    }


    public function composeSlot()
    {
        if (isset($_POST)) {
            //insert pour la table Rdvs
            $this->rdv->setStartDate($_POST['start']);
            $this->rdv->setEndDate($_POST['end']);
            $this->rdv->setStatus('slot');
            $this->rdv->setTitle('New Slot');
            $this->rdv->setDescription('defaultDescription');

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
            if (!$this->rdv->find($_POST['id'])) {
                return include "View/Partial/form.partial.php";
            }
            //insert pour la table Rdvs
            $this->rdv->setTitle($_POST['title']);
            $this->rdv->setStatus('rdv');
            $this->rdv->setLocation($_POST['location']);
            $this->rdv->setDescription($_POST['description']);
            //$this->rdv->setRdv_step_key();
            $this->rdv->setId($_POST['id']);
            $config = Validator::run($this->rdv->getFormNewMeeting(),$_POST);
            if (empty($config)) {
                $this->rdv->save();
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