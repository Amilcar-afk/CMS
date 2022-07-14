<?php

namespace App\Controller;
use App\Core\View;
use App\Core\Validator;
use App\Core\Query;
use App\Model\Configuration;
use App\Model\User;

class Setup{

    public function loadDatabase()
    {
        $config = new Configuration();
        $env_file = 'env.json';
        $data_base_env = yaml_parse_file($env_file);

        if (!empty($data_base_env['env'][0]['DBHOST'])
            && !empty($data_base_env['env'][0]['DBPWD'])
            && !empty($data_base_env['env'][0]['DBPORT'])
            && !empty($data_base_env['env'][0]['DBNAME'])
            && !empty($data_base_env['env'][0]['DBUSER'])){
            header("Location: /setup/register");
        }

        $config->setHost_name($data_base_env['env'][0]['DBHOST']);
        $config->setPassword($data_base_env['env'][0]['DBPWD']);
        $config->setPort($data_base_env['env'][0]['DBPORT']);
        $config->setDb_name($data_base_env['env'][0]['DBNAME']);
        $config->setDb_user($data_base_env['env'][0]['DBUSER']);

        $view = new View("setup/database", "back-sandbox");
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

        if (!empty($data_base_env['env'][1]['SMTP_HOST'])
            && !empty($data_base_env['env'][1]['SMTP_PORT'])
            && !empty($data_base_env['env'][1]['SMTP_SECURE'])
            && !empty($data_base_env['env'][1]['SMTP_USERNAME'])
            && !empty($data_base_env['env'][1]['SMTP_PASSWORD'])){
            header("Location: /setup/main-images");
        }

        $config->setSmtp_host($data_base_env['env'][1]['SMTP_HOST']);
        $config->setSmtp_port($data_base_env['env'][1]['SMTP_PORT']);

        $config->setSmtp_secure($data_base_env['env'][1]['SMTP_SECURE']);
        $config->setSmtp_username($data_base_env['env'][1]['SMTP_USERNAME']);
        $config->setSmtp_password($data_base_env['env'][1]['SMTP_PASSWORD']);

        $view = new View("setup/smtp", "back-sandbox");
        $view->assign("configuration", $config);
        $view->assign("metaData", $metaData = [
            "title" => 'Setup Smtp',
            "description" => 'Smtp configuration',
            "src" => [
                ["type" => "js", "path" => "/style/js/database.js"],
            ],
        ]);
    }

    public function loadMainImages()
    {
        $logo = Query::from('cmspf_Options')
            ->where("type = 'logo'")
            ->execute('Option');

        $favicon = Query::from('cmspf_Options')
            ->where("type = 'favicon'")
            ->execute('Option');

        if (isset($logo[0])
            || isset($favicon[0])){
            header("Location: /setup/design/1");
        }

        $view = new View("setup/main-images", "back-sandbox");
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
        $mainColor = Query::from('cmspf_Options')
            ->where("type = 'main_color'")
            ->execute('Option');

        $secondColor = Query::from('cmspf_Options')
            ->where("type = 'second_color'")
            ->execute('Option');

        $thirdColor = Query::from('cmspf_Options')
            ->where("type = 'third_color'")
            ->execute('Option');

        $backgroundColor = Query::from('cmspf_Options')
            ->where("type = 'background_color'")
            ->execute('Option');

        $textColor = Query::from('cmspf_Options')
            ->where("type = 'text_color'")
            ->execute('Option');

        if (isset($mainColor[0])
            || isset($secondColor[0])
            || isset($thirdColor[0])
            || isset($backgroundColor[0])
            || isset($textColor[0])){
            header("Location: /setup/main-images");
        }

        $view = new View("setup/main-colors", "back-sandbox");
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
        $radius = Query::from('cmspf_Options')
            ->where("type = 'radius'")
            ->execute('Option');

        if (isset($radius[0])){
            header("Location: /setup/design/2");
        }

        $view = new View("setup/design-first", "back-sandbox");
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
        $bessels = Query::from('cmspf_Options')
            ->where("type = 'bessels'")
            ->execute('Option');

        if (isset($bessels[0])){
            header("Location: /dashboard");
        }
        $view = new View("setup/design-second", "back-sandbox");
        $view->assign("metaData", $metaData = [
            "title" => 'Setup design 2/2',
            "description" => 'Design',
            "src" => [
                ["type" => "js", "path" => "/style/js/options.js"],
            ],
        ]);
    }
}