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
        $config->setDb_user($data_base_env['env'][0]['DBUSER']);

        $view = new View("Setup/database", "back-sandbox");
        $view->assign("configuration", $config);
        $view->assign("metaData", $metaData = [
            "title" => 'Setup Database',
            "description" => 'Database configuration',
            "src" => [
                ["type" => "js", "path" => "/style/js/database.js"],
            ],
        ]);
    }

    public function loadSmtp()
    {
        $config = new Configuration();
        $env_file = 'env.json';
        $data_base_env = yaml_parse_file($env_file);

        $config->setSmtp_host($data_base_env['env'][1]['SMTP_HOST']);
        $config->setSmtp_port($data_base_env['env'][1]['SMTP_PORT']);

        $config->setSmtp_secure($data_base_env['env'][1]['SMTP_SECURE']);
        $config->setSmtp_username($data_base_env['env'][1]['SMTP_USERNAME']);
        $config->setSmtp_password($data_base_env['env'][1]['SMTP_PASSWORD']);

        $view = new View("Setup/smtp", "back-sandbox");
        $view->assign("configuration", $config);
        $view->assign("metaData", $metaData = [
            "title" => 'Setup Smtp',
            "description" => 'Smtp configuration',
            "src" => [
                ["type" => "js", "path" => "/style/js/database.js"],
            ],
        ]);
    }

    public function loadLogin()
    {
        $view = new View("Setup/login", "back-sandbox");
    }

    public function loadMainImages()
    {
        $view = new View("Setup/main-images", "back-sandbox");
        $view->assign("metaData", $metaData = [
            "title" => 'Setup main images',
            "description" => 'main images',
            "src" => [
                ["type" => "js", "path" => "/style/js/options.js"],
            ],
        ]);
    }

    public function loadMainColors()
    {
        $view = new View("Setup/main-colors", "back-sandbox");
        $view->assign("metaData", $metaData = [
            "title" => 'Setup main colors',
            "description" => 'main colors',
            "src" => [
                ["type" => "js", "path" => "/style/js/options.js"],
                ["type" => "js", "path" => "https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"],
                ["type" => "css", "path" => "https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css"],
            ],
        ]);
    }

    public function loadDesignFirst()
    {
        $view = new View("Setup/design-first", "back-sandbox");
        $view->assign("metaData", $metaData = [
            "title" => 'Setup design 1/2',
            "description" => 'Design',
            "src" => [
                ["type" => "js", "path" => "/style/js/options.js"],
            ],
        ]);
    }

    public function loadDesignSecond()
    {
        $view = new View("Setup/design-second", "back-sandbox");
        $view->assign("metaData", $metaData = [
            "title" => 'Setup design 2/2',
            "description" => 'Design',
            "src" => [
                ["type" => "js", "path" => "/style/js/options.js"],
            ],
        ]);
    }
}