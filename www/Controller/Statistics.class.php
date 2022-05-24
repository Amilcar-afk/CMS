<?php

namespace App\Controller;

use App\Core\View;
use PDO;
use App\Model\Stat as Stat;

class Statistics
{

    public $stats;

    public function __construct()
    {

        $this->stats = new Stat;

    }


    public function loadDashboard() {

        $data = $this->stats->loadStats();

        // VIEW
        $view = new View("dashboard", "back");
        $view->assign("data", $data);

        // INCLUDE
        // include 'integration/dashboard.html';

    }

    public function getAllStats() {

        // GET PUBLIC IP
        $externalContent = file_get_contents('http://checkip.dyndns.com/');
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
        $externalIp = $m[1];

        // GET COUNTRY WITH IP
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$externalIp));
        $countryCode = $query['countryCode'];

        // VARIABLES
        $temps = time();
        $date = date("Y-m-d");   
        $page = basename($_SERVER['REQUEST_URI']);

        // INSERT STATS
        $this->stats->setType(1); // NOT OK
        $this->stats->setIp($externalIp); //OK
        $this->stats->setPageKey(1); // NOT OK
        $this->stats->setReseauSocKey(1); // NOT OK
        $this->stats->setCountry($countryCode); // OK
        $this->stats->setDate($date); // OK
        $this->stats->save();

    }
    
}