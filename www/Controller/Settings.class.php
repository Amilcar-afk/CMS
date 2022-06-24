<?php

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Data_base;
use App\Model\User;
use App\Model\Option;
use App\Core\Query;


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
        $users = Query::from('cmspf_Users')->where("deleted IS NULL OR deleted = 0")->execute("User");
        //$users = $this->user->find();
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
                $env_file = 'env.json';
                $data_base_env = yaml_parse_file($env_file);
                $this->database->setHost_name($data_base_env['host_name']);
                $this->database->setPassword($data_base_env['password']);
                $this->database->setPort($data_base_env['port']);
                $this->database->setDb_name($data_base_env['db_name']);

                $view = new View("database");
                $view->assign("database", $this->database);
            }else{
                return include "View/Partial/form.partial.php";
            }
        }
    }


    public function test()
    {
        include "sitemap.php";

    }

    public function loadDatabase()
    {
        //recuperer les info du fichier json
        $env_file = 'env.json';
        $data_base_env = yaml_parse_file($env_file);
        $this->database->setHost_name($data_base_env['host_name']);
        $this->database->setPassword($data_base_env['password']);
        $this->database->setPort($data_base_env['port']);
        $this->database->setDb_name($data_base_env['db_name']);
        $view = new View("database", "back");
        $view->assign("database", $this->database);
    }






    public function listMedia()
    {
        $view = new View("media-library", "back");
    }
}