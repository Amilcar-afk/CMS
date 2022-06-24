<?php

namespace App\Controller;

use App\Core\Query;
use App\Core\Validator;
use App\Core\View;
use App\Model\Stat;
use App\Model\Reseaux_soc;
use function MongoDB\BSON\fromJSON;

class Statistics
{

    public $stats;



    public function __construct()
    {
        $this->stats = new Stat;
    }



    public function loadDashboard() {

        $reseauxSoc = new Reseaux_soc();
        $emptyReseauxSoc = $reseauxSoc;
        $reseauxSocs = $reseauxSoc->find();

        $stats = $this->stats->find();

        foreach($stats as $stat){
            $sortedData['per-device'][] = [
                "device" => $stat->getDevice(),
                "date" => $stat->getDate()
            ];
            $sortedData['page-ranking'][] = [
                "page_key" => $stat->getPageKey(),
                "page_name" => $stat->page()->getTitle(),
                "date" => $stat->getDate()
            ];
            $sortedData['page-ranking'][] = [
                "page_key" => $stat->getPageKey(),
                "page_name" => $stat->page()->getTitle(),
                "date" => $stat->getDate()
            ];

            $listPage[$stat->getPageKey()][] = [
                "page_key" => $stat->getPageKey(),
                "page_name" => $stat->page()->getTitle(),
                "date" => $stat->getDate()
            ];

        }

        /*foreach ($stats as $stat){
            if (isset() && ){
                $page[$stat->getPageKey()]["total_views"] = $page[$stat->getPageKey()]["total_views"]++;
            }
        }

        $page = [
            "index_page" => [
                "page_name" => $stat->getPageKey()
                "total_views" => $stat->getDate()
            ]
        ];*/

        
        $view = new View("dashboard", "back");
        $view->assign("data", $stats);
        //$view->assign("sortedData", $sortedData);
        $view->assign("reseauxSocs", $reseauxSocs);
        $view->assign("emptyReseauxSoc", $emptyReseauxSoc);
    }

    public function composeReseauxSoc() {

        if( isset($_POST) ) {
            $reseauxSoc = new Reseaux_soc();
            $reseauxSoc->setPath($_POST['link']);
            $reseauxSoc->setType($_POST['type']);
            $reseauxSoc->setUserKey($_SESSION['Auth']->id);
            $reseauxSocOfThisType = Query::from('cmspf_Reseaux_soc')
                ->where("type = '" . $_POST['type'] . "'")
                ->execute('Reseaux_soc');
            if (isset($reseauxSocOfThisType[0])){
                $reseauxSoc->setId($reseauxSocOfThisType[0]->getId());
            }
            $config = Validator::run($reseauxSoc->getFormNewReseauxSoc(), $_POST);
            if (empty($config)) {
                $reseauxSoc->save();

                $reseauxSoc = new Reseaux_soc();
                $emptyReseauxSoc = $reseauxSoc;
                $reseauxSocs = $reseauxSoc->find();

                $stats = $this->stats->find();

                $view = new View("dashboard");
                $view->assign("data", $stats);
                $view->assign("reseauxSocs", $reseauxSocs);
                $view->assign("emptyReseauxSoc", $emptyReseauxSoc);

            } else {
                return include "View/Partial/form.partial.php";
            }
        }else{
            http_response_code(500);
        }
    }

    function deleteReseauxSoc()
    {
        if( isset($_POST['id']) ) {
            $reseauxSoc = new Reseaux_soc();
            $reseauxSoc = $reseauxSoc->find($_POST['id']);
            if ($reseauxSoc->getId() != null) {

                Query::deleteAll('')->from('cmspf_Stats')->where("reseau_soc_key = " . $_POST['id'] . "")->execute();
                $reseauxSoc->delete($_POST['id']);
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(500);
        }
    }

    public function composeStats(int $elementId, string $type) {

        if (!isset($elementId) && !isset($type))
            die();

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


        // INSERT STATS
        if ($type == "view") {
            $this->stats->setPageKey($elementId); // OK
        }elseif ($type == "reseaux_soc") {
            $this->stats->setReseauSocKey($elementId); // OK
        }
        $this->stats->setType($type); // OK
        $this->stats->setIp($externalIp); //OK
        $this->stats->setCountry($countryCode); // OK
        $this->stats->setDate($date); // OK
        $this->stats->setDevice($device); // OK
        $this->stats->save(); 

    }
    
}