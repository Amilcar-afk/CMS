<?php

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Configuration;
use App\Model\User;
use App\Model\Option;
use App\Core\Query;


class Settings
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
        $this->config = new Configuration();

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

            if(isset($_POST['DBHOST'])){
                $config = Validator::run($this->config->dataBaseForm(),$_POST);
            }else{
                $config = Validator::run($this->config->smtpForm(),$_POST);
            }

            if(empty($config)){
                $filename = './env.json';
                $info = json_encode($_POST);
                if (file_exists($filename)) {
                    $env_file = 'env.json';
                    $data_base_env = yaml_parse_file($env_file);

                    foreach($_POST as $key => $data){
                        if(count($_POST) == 4){
                            $data_base_env['env'][0]=$_POST;

                            echo count($_POST);
                        }else{
                            $data_base_env['env'][1]=$_POST;

                        }
                    }
                    $data = json_encode($data_base_env);
                    file_put_contents($filename, $data);
                } else {
                    $filename = fopen('./env.json','w+') ;
                    fwrite($filename, $info);
                    fclose($filename);
                }
                $env_file = 'env.json';
                $data_base_env = yaml_parse_file($env_file[]);
                
                $this->config->setHost_name($data_base_env['env'][0]['DBHOST']);
                $this->config->setPassword($data_base_env['env'][0]['DBPWD']);
                $this->config->setPort($data_base_env['env'][0]['DBPORT']);
                $this->config->setDb_name($data_base_env['env'][0]['DBNAME']);

                $this->config->setMail_adresse($data_base_env['env'][1]['MAILADDR']);
                $this->config->setMail_pwd($data_base_env['env'][1]['MAILPWD']);
                $this->config->setSmtp_host($data_base_env['env'][1]['SMTP_HOST']);
                $this->config->setSmtp_port($data_base_env['env'][1]['SMTP_PORT']);
        
                $this->config->setDb_user($data_base_env['env'][1]['DBUSER']);
                $this->config->setSmtp_secure($data_base_env['env'][1]['SMTP_SECURE']);
                $this->config->setSmtp_username($data_base_env['env'][1]['SMTP_USERNAME']);
                $this->config->setSmtp_password($data_base_env['env'][1]['SMTP_PASSWORD']);

                $view = new View("database");
                $view->assign("configuration", $this->config);
            }else{
                return include "View/Partial/form.partial.php";
            }
        }
    }




    public function loadDatabase()
    {
        //recuperer les info du fichier json
        $env_file = 'env.json';
        $data_base_env = yaml_parse_file($env_file);
        $this->config->setHost_name($data_base_env['env'][0]['DBHOST']);
        $this->config->setPassword($data_base_env['env'][0]['DBPWD']);
        $this->config->setPort($data_base_env['env'][0]['DBPORT']);
        $this->config->setDb_name($data_base_env['env'][0]['DBNAME']);

        $this->config->setMail_adresse($data_base_env['env'][1]['MAILADDR']);
        $this->config->setMail_pwd($data_base_env['env'][1]['MAILPWD']);
        $this->config->setSmtp_host($data_base_env['env'][1]['SMTP_HOST']);
        $this->config->setSmtp_port($data_base_env['env'][1]['SMTP_PORT']);

        $this->config->setDb_user($data_base_env['env'][1]['DBUSER']);
        $this->config->setSmtp_secure($data_base_env['env'][1]['SMTP_SECURE']);
        $this->config->setSmtp_username($data_base_env['env'][1]['SMTP_USERNAME']);
        $this->config->setSmtp_password($data_base_env['env'][1]['SMTP_PASSWORD']);

        $view = new View("database", "back");
        $view->assign("configuration", $this->config);
    }






    public function listMedia()
    {
        $view = new View("media-library", "back");
    }
}