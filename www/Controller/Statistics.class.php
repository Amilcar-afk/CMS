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

        //$data = $this->stats->find();
        $sql = "SELECT * FROM cmspf_Stats order by id";
        $data = $this->stats->loadStats($sql);

        // VIEW
        $view = new View("dashboard", "back");
        $view->assign("data", json_encode($data));

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

        // GET DEVICES
        $detectDevice = $_SERVER['HTTP_USER_AGENT'];
        $isMobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        if ($isMobile) {

            if (strpos($detectDevice,"iPhone") || strpos($detectDevice,"iPad") || strpos($detectDevice,"iPod")){
                $device = "Ios";
            } else if (strpos($detectDevice,"Android")){
                $device = "Android";
            } else {
                $device = "Other";
            }

        } else {

            if (strpos($detectDevice,"Windows")){
                $device = "Windows";
            } else if (strpos($detectDevice,"Mac OS X")){
                $device = "MacOs";
            } else {
                $device = "Other";
            }

        }

        // GET DATE
        $date = date("Y-m-d");

        // GET PAGE KEY


        // INSERT STATS
        $this->stats->setType(1); // NOT OK
        $this->stats->setIp($externalIp); //OK
        $this->stats->setPageKey(1); // NOT OK
        $this->stats->setReseauSocKey(1); // NOT OK
        $this->stats->setCountry($countryCode); // OK
        $this->stats->setDate($date); // OK
        $this->stats->setDevice($device); // OK
        $this->stats->save();

    }
    
}