<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Rdvs as dd;
use PDO;

class RendezVous{

    public $rdv;

    public function __construct()
    {
        $this->rdv = new dd();
    }

    public function calendar()
    {
        $view = new View("rendezvous");
    }

    public function load()
    {
        $sql = "SELECT * FROM cmsp_rdvs order by id";
        $data = $this->rdv->loadCalendar($sql);
        foreach ($data as $row) {
            $allRdvs[] = array(
            "id" => $row->id,
            "start" => $row->startDate,
            "end" => $row->endDate,
          );
            }
        echo json_encode($allRdvs);
    }

    public function insertRdv()
    {
        if(isset($_POST['start'])){
            $this->rdv->setTitle('titre');
            $this->rdv->setStartDate($_POST['start']);
            $this->rdv->setEndDate($_POST['end']);
            $this->rdv->setStatus(1);
            $this->rdv->setLocation('location');
            $this->rdv->setDescription('desc');
            $this->rdv->setRdv_step_key(1);
            $this->rdv->save();
        }else{
            echo 'Nok';
        }
    }

    public function deleteEvent()
    {
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $sql = "DELETE FROM cmsp_rdvs WHERE id=:id";
            $this->rdv->deleteEvent($sql,['id'=> $id]);
        }
       
    }

    public function updateEvent()
    {
        if(isset($_POST['id']))
        {
            $this->rdv->setId($_POST['id']);
            $this->rdv->setEndDate($_POST['end']);
            $this->rdv->setStartDate($_POST['start']);
            $this->rdv->setRdv_step_key(1);
            $this->rdv->save();
        }
    }


    public function public_rdvs_List()
    {
        $sql = "SELECT * FROM cmsp_rdvs order by id";
        $data = $this->rdv->loadCalendar($sql);
        foreach ($data as $row) {
            $allRdvs[] = array(
            "id" => $row->id,
            "start" => $row->startDate,
            "end" => $row->endDate,
          );
        }
        $view = new View("public/rendez-vous/rdvslist");
        $view->assign("allRdvs", $allRdvs);

    }

    public function public_rdvs_reserver()
    {
        $id = $this->rdv->getPramsFromUri();
        $sql = "SELECT * FROM cmsp_rdvs WHERE id= :id";
        $currentRdv =$this->rdv->selectOneByData($sql,['id'=>$id]);

        $this->rdv->setId($currentRdv->id);
        $this->rdv->setTitle($currentRdv->title);
        $this->rdv->setLocation($currentRdv->location);
        $this->rdv->setDescription($currentRdv->description);


        if($_POST){
            var_dump($_POST);
            $this->rdv->setId($_POST['id']);
            $this->rdv->setTitle($_POST['title']);
            $this->rdv->setLocation($_POST['location']);
            $this->rdv->setDescription($_POST['description']);
            $this->rdv->save();
        }

        $view = new View("public/rendez-vous/rdvsupdate");
        $view->assign("currentRdv", $currentRdv);
        $view->assign("rdv",$this->rdv);

    }

}