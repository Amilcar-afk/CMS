<?php

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Configuration;
use App\Model\User;
use App\Core\Query;



class Settings
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
        $this->config = new Configuration();

    }

    public function listUser()
    {
        $view = new View("user-manager", "back");
        $users = Query::from('cmspf_Users')->or("deleted IS NULL" , "deleted = 0")->execute("User");
        //$users = $this->user->find();
        $categories = Query::from('cmspf_Categories')->where("type = 'tag'")->execute('Categorie');
        $view->assign("users", $users);
        $view->assign("newuser", $this->user);

        $view->assign("metaData", $metaData = [
            "title" => 'User manager',
            "description" => 'Manage your users here',
            "src" => [
                ["type" => "js", "path" => "https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"],
                ["type" => "css", "path" => "https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"],
                ["type" => "js", "path" => "../js/ajax/user-manager.js"],
                ["type" => "js", "path" => "../js/ajax/httpRequest.js"],
            ],
        ]);
    }

    public function userCompose()
    {

        if( !empty($_POST)){
            $date = date("Y-m-d");
            $this->user->setFirstname($_POST['firstname']);
            $this->user->setLastname($_POST['lastname']);
            $this->user->setPassword($_POST['password']);
            $this->user->setMail($_POST['email']);
            $this->user->setRank('user');
            $this->user->setConfirm(1);
            $this->user->setDateCreation($date);
            $this->user->generateToken();

            $unic_email = Query::from('cmspf_Users')
                            ->where("mail = '" . $_POST['email'] . "' AND (deleted IS NULL OR deleted = 0) AND confirm = 1")
                            ->execute("User");

            if(!count($unic_email) > 0){
                $config = Validator::run($this->user->getFormRegister(), $_POST,false);
            }else{
                $config = Validator::run($this->user->getFormRegister(), $_POST,$unic_email);
            }
            
            if(empty($config)){
                $this->user->generateConfirmKey($_POST['email']);
                $this->user->save();

                echo 1;

            }else{
                return include "View/Partial/form.partial.php";
            }
        }


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

                    echo "total".count($_POST);
                    print_r($_POST);

                    foreach($_POST as $key => $data){
                        if(isset($_POST['DBHOST'])){
                            $data_base_env['env'][0]=$_POST;
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
                $data_base_env = yaml_parse_file($env_file);
                
                $this->config->setHost_name($data_base_env['env'][0]['DBHOST']);
                $this->config->setPassword($data_base_env['env'][0]['DBPWD']);
                $this->config->setPort($data_base_env['env'][0]['DBPORT']);
                $this->config->setDb_name($data_base_env['env'][0]['DBNAME']);
                $this->config->setDb_user($data_base_env['env'][0]['DBUSER']);

                $this->config->setSmtp_host($data_base_env['env'][1]['SMTP_HOST']);
                $this->config->setSmtp_port($data_base_env['env'][1]['SMTP_PORT']);

                $this->config->setSmtp_secure($data_base_env['env'][1]['SMTP_SECURE']);
                $this->config->setSmtp_username($data_base_env['env'][1]['SMTP_USERNAME']);
                $this->config->setSmtp_password($data_base_env['env'][1]['SMTP_PASSWORD']);
                $this->config->insertDatabase();

                $view = new View("configuration");
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
        $this->config->setDb_user($data_base_env['env'][0]['DBUSER']);

        $this->config->setSmtp_host($data_base_env['env'][1]['SMTP_HOST']);
        $this->config->setSmtp_port($data_base_env['env'][1]['SMTP_PORT']);

        $this->config->setSmtp_secure($data_base_env['env'][1]['SMTP_SECURE']);
        $this->config->setSmtp_username($data_base_env['env'][1]['SMTP_USERNAME']);
        $this->config->setSmtp_password($data_base_env['env'][1]['SMTP_PASSWORD']);

        $view = new View("configuration", "back");
        $view->assign("configuration", $this->config);
        $view->assign("metaData", $metaData = [
            "title" => 'Configuration',
            "description" => 'Change your webstite configuration here. Database & SMTP configuration',
            "src" => [
                ["type" => "js", "path" => "../style/js/database.js"],
            ],
        ]);
    }
}