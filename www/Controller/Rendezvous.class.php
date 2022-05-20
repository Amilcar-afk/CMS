<?php

namespace App\Controller;
use App\Core\View;
use App\Model\Rdv as rdvModel;
use App\Model\User_rdv as User_rdv;
use App\Controller\Authadmin;
use PDO;

class RendezVous{

    public $rdv;
    public $authAdmin ;
    public $user_rdv;

    public function __construct()
    {
        $this->rdv = new rdvModel();
        $this->user_rdv = new User_rdv();
        $this->authAdmin = new Authadmin();
        Authadmin::isLogged();
    }

    public function calendar()
    {
        $view = new View("rendezvous");
    }

    public function load()
    {
        $sql = "SELECT * FROM cmspf_Rdvs order by id";
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
            //insert pour la table Rdvs
            $this->rdv->setTitle('titre');
            $this->rdv->setStartDate($_POST['start']);
            $this->rdv->setEndDate($_POST['end']);
            $this->rdv->setStatus(1);
            $this->rdv->setLocation('location');
            $this->rdv->setDescription('desc');
            $this->rdv->setRdv_step_key(1);
            $this->rdv->save();
            //insert pour la table User_rdv
            $lastId = $this->rdv->getLastId();
            if($lastId){
                $userId = $_SESSION['Auth']->id;
                $this->user_rdv->setType(1);
                $this->user_rdv->setUser_key($userId);
                $this->user_rdv->setRdv_key($lastId);
                $this->user_rdv->save();
            }

        }else{
            echo 'Nok';
        }
    }


    public function deleteEvent()
    {
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $sql = "DELETE FROM cmspf_Rdvs WHERE id=:id";
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
        $sql = "SELECT * FROM cmspf_Rdvs order by id";
        $data = $this->rdv->loadCalendar($sql);
        foreach ($data as $row) {
            $allRdvs[] = array(
            "id" => $row->id,
            "start" => $row->startDate,
            "end" => $row->endDate,
            "status" => $row->status,

          );
        }
        $view = new View("public/rendez-vous/rdvslist");
        $view->assign("allRdvs", $allRdvs);

    }

    public function public_rdvs_reserver()
    {
        $id = $this->rdv->getPramsFromUri();
        $sql = "SELECT * FROM cmspf_Rdvs WHERE id= :id";
        $currentRdv =$this->rdv->selectOneByData($sql,['id'=>$id['id']]);

        $this->rdv->setId($currentRdv->id);
        $this->rdv->setTitle($currentRdv->title);
        $this->rdv->setLocation($currentRdv->location);
        $this->rdv->setDescription($currentRdv->description);


        if($_POST){
            $this->rdv->setId($_POST['id']);
            $this->rdv->setTitle($_POST['title']);
            $this->rdv->setLocation($_POST['location']);
            $this->rdv->setDescription($_POST['description']);
            $this->rdv->setStatus(2);
            $this->rdv->save();


            $userId = $_SESSION['Auth']->id;

            
            $this->user_rdv->setType(2);
            $this->user_rdv->setUser_key($userId);
            $this->user_rdv->setRdv_key($_POST['id']);
            $this->user_rdv->save();
            header('location:/public_rdvs_list');
        }

        $view = new View("public/rendez-vous/rdvsupdate");
        $view->assign("currentRdv", $currentRdv);
        $view->assign("rdv",$this->rdv);

    }


    public function test()
    {
        $id = $this->rdv->getPramsFromUri();
    }

}