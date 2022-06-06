<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Rdv;

class Meeting
{
    public $rdv;

    public function __construct()
    {
        $this->rendezVous = new Rdv();
    }

    public function listMeeting()
    {
        $view = new View("meeting-list", "back");
    }

    public function listSlot()
    {
        $view = new View("slot-list", "back");
    }
}