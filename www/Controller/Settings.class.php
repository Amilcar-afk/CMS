<?php

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Data_base;
use App\Model\User;
use App\Model\Option;


class Settings
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
        $this->database = new Data_base();

    }

    public function listStyle()
    {
        $view = new View("style", "back");
    }

    public function listUser()
    {
        $users = $this->user->find();
        $view = new View("user-manager", "back");
        $view->assign("users", $users);
    }

    public function composeDatabase()
    {
        if($_POST){
            $config = Validator::run($this->database->dataBaseForm(),$_POST);
            if(empty($config)){
                $filename = './env.json';
                $info = json_encode($_POST);
                if (file_exists($filename)) {
                    file_put_contents($filename, $info);
                } else {
                    $filename = fopen('./env.json','w+') ;
                    fwrite($filename, $info);
                    fclose($filename);
                }

                //recuperer les info du fichier json
                $view = new View("database");
                $view->assign("database", $this->database);
            }else{
                return include "View/Partial/form.partial.php";
            }
        }
    }

    public function loadDatabase()
    {
        //recuperer les info du fichier json
        $view = new View("database", "back");
        $view->assign("database", $this->database);
    }






    public function listMedia()
    {
        $view = new View("media-library", "back");
    }
}