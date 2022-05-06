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
            $tabMs[] = array(
            "id" => $row->id,
            "start" => $row->startDate,
            "end" => $row->endDate,
          );
            }
        echo json_encode($tabMs);
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


}