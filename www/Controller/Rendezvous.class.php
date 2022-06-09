<?php

namespace App\Controller;
use App\Core\Validator;
use App\Core\View;
use App\Model\Rdv as rdvModel;
use App\Model\User_rdv as User_rdv;
use PDO;

class RendezVous{

    public $rdv;
    public $authAdmin ;
    public $user_rdv;
    

    public function __construct()
    {
        $this->rdv = new rdvModel();
        $this->user_rdv = new User_rdv();
    }


    public function load()
    {
        $statusOfUser = $_SESSION['Auth']->rank;

        $sql = "SELECT * FROM cmspf_Rdvs order by id";
        $data = $this->rdv->loadCalendar($sql);
        foreach ($data as $row) {

            if($statusOfUser != 1 && $row->status === 'rdv'){
                continue;
            }
            
            if($row->status === 'slot'){
                $color = '#32CD32';
            }else{
                $color = '#DC143C';
            }
            $allRdvs[] = array(
                "id" => $row->id,
                "title"=>$row->title,
                "rank"=>$statusOfUser,
                "start" => $row->startDate,
                "end" => $row->endDate,
                "color" => $color,
            );
        }

        echo json_encode($allRdvs);
    }





    public function public_rdvs_List()
    {
        $sql = "SELECT * FROM cmspf_Rdvs order by id";
        $data = $this->rdv->loadCalendar($sql);
        $allRdvs = [];
        if (isset($data)) {
            foreach ($data as $row) {
                $allRdvs[] = array(
                    "id" => $row->id,
                    "start" => $row->startDate,
                    "end" => $row->endDate,
                    "status" => $row->status,
                );
            }
        }
        $view = new View("public/rdvs-list", "back");
        $view->assign("allRdvs", $allRdvs);
    }

    public function public_rdvs_reserver($id)
    {
        $sql = "SELECT * FROM cmspf_Rdvs WHERE id= :id";
        $currentRdv =$this->rdv->selectOneByData($sql,['id'=>$id['id']]);
        $this->rdv->setId($currentRdv->id);
        $this->rdv->setTitle($currentRdv->title);
        $this->rdv->setLocation($currentRdv->location);
        $this->rdv->setDescription($currentRdv->description);

        if(isset($_POST['id'])){
            $this->rdv->setId($_POST['id']);
            $this->rdv->setTitle($_POST['title']);
            $this->rdv->setLocation($_POST['location']);
            $this->rdv->setDescription($_POST['description']);
            $this->rdv->setStatus('rdv');
            $this->rdv->save();
            $userId = $_SESSION['Auth']->id;
            $this->user_rdv->setType(2);
            $this->user_rdv->setUser_key($userId);
            $this->user_rdv->setRdv_key($_POST['id']);
            $this->user_rdv->save();
            header('location:/rdv_calendar');
        }
        $view = new View("public/rdvsupdate");
        $view->assign("rdv",$this->rdv);
    }

}