<?php

namespace App\Controller;

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

    public function listRdv()
    {

        $view = new View("meeting-list", "back");
    }

    public function listSlot()
    {
        $view = new View("slot-list", "back");
    }


    public function composeSlot()
    {
        if (isset($_POST)) {
            //insert pour la table Rdvs
            var_dump($_POST);
            $this->rdv->setStartDate($_POST['start']);
            $this->rdv->setEndDate($_POST['end']);
            $this->rdv->setStatus('slot');
            // if (isset($_POST['id']) && $_POST['id'] != null) {
            //     if (!$this->rdv->find($_POST['id'])) {
            //         return include "View/Partial/form.partial.php";
            //     }
            //     $this->rdv->setId($_POST['id']);
            // }

            // $config = Validator::run($this->rdv->getFormNewSlot(), $_POST);

            // if (empty($config)) {
            //     $this->rdv->save();
            //     //insert pour la table User_rdv
            //     $lastId = $this->rdv->getLastId();
            //     if ($lastId && !isset($_POST['id'])) {
            //         $this->user_rdv->setType('owner');
            //         $this->user_rdv->setUser_key($_SESSION['Auth']->id);
            //         $this->user_rdv->setRdv_key($lastId);
            //         $this->user_rdv->save();
            //     }
            // }
        }

    }

    public function composeMeeting()
    {
        if (isset($_POST)) {
            if (!$this->rdv->find($_POST['id'])) {
                return include "View/Partial/form.partial.php";
            }
            //insert pour la table Rdvs
            $this->rdv->setTitle('titre');
            $this->rdv->setStatus('rdv');
            $this->rdv->setLocation($_POST['location']);
            $this->rdv->setDescription($_POST['description']);
            //$this->rdv->setRdv_step_key();
            $this->rdv->setId($_POST['id']);
            $config = Validator::run($this->rdv->getFormNewMeeting(), $_POST);
            if (empty($config)) {
                $this->rdv->save();
                //insert pour la table User_rdv
                $lastId = $this->rdv->getLastId();
                if ($lastId) {
                    $this->user_rdv->setType('customer');
                    $this->user_rdv->setUser_key($_SESSION['Auth']->id);
                    $this->user_rdv->setRdv_key($lastId);
                    $this->user_rdv->save();
                }
            }
        }
    }
}