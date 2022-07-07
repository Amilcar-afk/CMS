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


        // RANGE
        $toPerPage = date("Y-m-d");
        $sincePerPage = date('Y-m-d', strtotime($toPerPage. ' - 1 month'));
        $toPerCountry = date("Y-m-d");
        $sincePerCountry = date('Y-m-d', strtotime($toPerCountry. ' - 1 month'));
        $toPerDevice = date("Y-m-d");
        $sincePerDevice = date('Y-m-d', strtotime($toPerDevice. ' - 1 month'));
        
        if(isset($_POST['sincePerPage'])){

            $sincePerPage = $_POST['sincePerPage'];
            $toPerPage = $_POST['toPerPage'];
            $viewPerPages = Query::select("COUNT(page_key) AS number, title")->from("cmspf_Stats")->innerJoin(" cmspf_Pages ON cmspf_Stats.page_key = cmspf_Pages.id")->where(" date BETWEEN '".$sincePerPage."' AND '".$toPerPage."'")->groupBy("title")->execute();

        }
        if(isset($_POST['sincePerCountry'])) {

            $sincePerCountry = $_POST['sincePerCountry'];
            $toPerCountry = $_POST['toPerCountry'];
            $country = Query::select("COUNT(country) AS number, country")->from("cmspf_Stats")->where(" date BETWEEN '".$sincePerCountry."' AND '".$toPerCountry."'")->groupBy("country")->execute();

        }
        if(isset($_POST['sincePerDevice'])) {

            $sincePerDevice = $_POST['sincePerDevice'];
            $toPerDevice = $_POST['toPerDevice'];
            $devices = Query::select("COUNT(device) AS number, device")->from("cmspf_Stats")->where(" date BETWEEN '".$sincePerDevice."' AND '".$toPerDevice."'")->groupBy("device")->execute();

        }


        // GET VIEW PER DAY FOR A WEEK
        // SELECT COUNT(page_key) as number, DAYOFWEEK(date) as day FROM cmspf_Stats WHERE YEAR( date ) = YEAR ( CURDATE() ) AND WEEK( date ) = WEEK ( CURDATE() ) GROUP BY day;
        $currentDate = date("Y-m-d");
        // $beforeDate = $currentDate('Y-m-d', strtotime('-7 day'));
        $currentDay = date('D', strtotime($currentDate));
        $currentMonth = date('m',strtotime($currentDate));
        $monthName = date('F', mktime(0, 0, 0, $currentMonth, 10));
        $viewPerWeek = Query::select("COUNT(page_key) AS number, DAYOFWEEK(date) as day")->from("cmspf_Stats")->where("YEAR(date) = YEAR('".$currentDate."') AND WEEK(date) = WEEK('".$currentDate."')")->groupBy("day")->execute();
        $chartWeekData[] = ['Day','',["role" => 'annotation' ]];

        foreach($viewPerWeek as $key => $value){

            if ($value['day'] == "1") {
                $viewPerWeek[$key]['day'] = "Sun";
            }
            if ($value['day'] == "2") {
                $viewPerWeek[$key]['day'] = "Mon";
            }
            if ($value['day'] == "3") {
                $viewPerWeek[$key]['day'] = "Tue";
            }
            if ($value['day'] == "4") {
                $viewPerWeek[$key]['day'] = "Wed";
            }
            if ($value['day'] == "5") {
                $viewPerWeek[$key]['day'] = "Thu";
            }
            if ($value['day'] == "6") {
                $viewPerWeek[$key]['day'] = "Fri";
            }
            if ($value['day'] == "7") {
                $viewPerWeek[$key]['day'] = "Sat";
            }

        }
        
        foreach($viewPerWeek as $key => $data) {
            $chartWeekData[] = [
                $data['day'],
                $toInt = (int)$data['number'],
                $toInt = (int)$data['number']
            ];
        }
        $test = "test";
        
        if(isset($_POST['name'])){
            echo $test = "gg";
        }


        // GET VIEW PER PAGES
        $viewPerPages = Query::select("COUNT(page_key) AS number, title")->from("cmspf_Stats")->innerJoin(" cmspf_Pages ON cmspf_Stats.page_key = cmspf_Pages.id")->where(" date BETWEEN '".$sincePerPage."' AND '".$toPerPage."'")->groupBy("title")->execute();
        arsort($viewPerPages);

        
        // GET COUNTRY STATS
        $country = Query::select("COUNT(country) AS number, country")->from("cmspf_Stats")->where(" date BETWEEN '".$sincePerCountry."' AND '".$toPerCountry."'")->groupBy("country")->execute();

        $chartMapData[] = ['Country',["role"=> 'annotation']];

        foreach($country as $key => $data) {
            $chartMapData[] = [
                $data['country'],
                $toInt = (int)$data['number']
            ];
        }
        


        // GET DEVICE STATS
        $devices = Query::select("COUNT(device) AS number, device")->from("cmspf_Stats")->where(" date BETWEEN '".$sincePerDevice."' AND '".$toPerDevice."'")->groupBy("device")->execute();

        $chartDeviceData[] = ['Device',["role"=> 'annotation']];
        foreach($devices as $device) {
            $chartDeviceData[] = [
                $device['device'],
                $toInt = (int)$device['number']
            ];
        }
        

        // GET NEW USERS STATS
        $currentMonth = date("m");
        $newUsers = Query::select("COUNT(*) AS number")->from("cmspf_Users")->where("MONTH (date_creation) = ".$currentMonth)->execute();
        $numberOfUsers = $newUsers[0]['number'];

        // ASSIGN VIEWS
        $tmpl = "back";
        if (isset($_POST['range'])) {
            $tmpl= "";
        }
        $view = new View("dashboard", $tmpl);
        $view->assign("chartWeekData", $chartWeekData);
        $view->assign("monthName", $monthName);
        $view->assign("viewPerPages", $viewPerPages);
        $view->assign("chartDeviceData", $chartDeviceData);
        $view->assign("numberOfUsers", $numberOfUsers);
        $view->assign("chartMapData", $chartMapData);
        $view->assign("data", $stats);
        $view->assign("reseauxSocs", $reseauxSocs);
        $view->assign("emptyReseauxSoc", $emptyReseauxSoc);

        $view->assign("metaData", $metaData = [
            "title" => 'Style',
            "description" => 'Change your webstite style',
            "src" => [
                ["type" => "js", "path" => "../style/js/getRange.js"],
                ["type" => "js", "path" => "https://www.gstatic.com/charts/loader.js"],
                ["type" => "js", "path" => "../style/js/reseauxSoc.js"],
            ],
        ]);
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
        

        //
        if ($type == "view") {
            $this->stats->setPageKey($elementId); // OK
            $attributType = "page_key";
        }elseif ($type == "reseaux_soc") {
            $this->stats->setReseauSocKey($elementId); // OK
            $attributType = "reseaux_soc_key";
        }



        // 1 STAT PER PAGE PER DAY
        $getLastDate = Query::select("MAX(date) AS date")->from("cmspf_Stats")->where("ip = '". $externalIp . "' AND ". $attributType ." = ". $elementId)->execute('Stat');

        $date1 = date("Y-m-d");
        $date2 = $getLastDate[0]->getDate();
        $first = strtotime($date1);
        $second = strtotime($date2);
        $dateDiff = abs($first - $second);
        $day = floor($dateDiff / (60 * 60 * 24));
        
        if ($day >= 1) {

            // INSERT STATS
            $this->stats->setType($type); 
            $this->stats->setIp($externalIp); 
            $this->stats->setCountry($countryCode);
            $this->stats->setDate($date); 
            $this->stats->setDevice($device); 
            $this->stats->save();

        } else {
            
        }
    }
    
}