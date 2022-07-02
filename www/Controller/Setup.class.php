<?php

namespace App\Controller;
use App\Core\View;
use App\Core\Validator;
use App\Core\Query;
use App\Model\Configuration;

class Setup{

    public function loadDatabase()
    {
        $config = new Configuration();
        $env_file = 'env.json';
        $data_base_env = yaml_parse_file($env_file);
        $config->setHost_name($data_base_env['env'][0]['DBHOST']);
        $config->setPassword($data_base_env['env'][0]['DBPWD']);
        $config->setPort($data_base_env['env'][0]['DBPORT']);
        $config->setDb_name($data_base_env['env'][0]['DBNAME']);

        $view = new View("Setup/database", "back-sandbox");
        $view->assign("configuration", $config);
    }

    public function loadSmtp()
    {
        $config = new Configuration();
        $env_file = 'env.json';
        $data_base_env = yaml_parse_file($env_file);

        $config->setMail_adresse($data_base_env['env'][1]['MAILADDR']);
        $config->setMail_pwd($data_base_env['env'][1]['MAILPWD']);
        $config->setSmtp_host($data_base_env['env'][1]['SMTP_HOST']);
        $config->setSmtp_port($data_base_env['env'][1]['SMTP_PORT']);

        $config->setDb_user($data_base_env['env'][1]['DBUSER']);
        $config->setSmtp_secure($data_base_env['env'][1]['SMTP_SECURE']);
        $config->setSmtp_username($data_base_env['env'][1]['SMTP_USERNAME']);
        $config->setSmtp_password($data_base_env['env'][1]['SMTP_PASSWORD']);

        $view = new View("Setup/smtp", "back-sandbox");
        $view->assign("configuration", $config);
    }

    public function loadLogin()
    {
        $view = new View("Setup/login", "back-sandbox");
    }

    public function loadMainImages()
    {
        $view = new View("Setup/main-images", "back-sandbox");
    }

    public function loadMainColors()
    {
        $view = new View("Setup/main-colors", "back-sandbox");
    }

    public function loadDesignFirst()
    {
        $view = new View("Setup/design-first", "back-sandbox");
    }

    public function loadDesignSecond()
    {
        $view = new View("Setup/design-second", "back-sandbox");
    }
}