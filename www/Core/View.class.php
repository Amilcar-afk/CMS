<?php

namespace App\Core;
use App\Core\Query;

class View
{
    private $view;
    private $template = null;
    private $data = [];
    private $array = [];

    public function __construct($view, $template = null)
    {
        $this->setView($view);
        if ($template != null){
            $this->setTemplate($template);
        }
    }

    
    public function setView($view){
        $this->view = strtolower($view);
    }


    public function setTemplate($template){
        $this->template = strtolower($template);
    }

    public function assign($key, $value):void
    {
        $this->data[$key] = $value;
    }

    public function __toString():string
    {
        return "Ceci est la classe View";
    }

    public function includePartial($name, $config=null)
    {
        if(!file_exists("View/Partial/".$name.".partial.php"))
        {
            die("partial ".$name." 404");
        }

        if ($name == 'design-variables'){
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

            $radius = Query::from('cmspf_Options')
                ->where("type = 'radius'")
                ->execute('Option');

            $bessels = Query::from('cmspf_Options')
                ->where("type = 'bessels'")
                ->execute('Option');
        }
        include "View/Partial/".$name.".partial.php";
    }

    public function __destruct()
    {
        extract($this->data);
        $logo = Query::from('cmspf_Options')
            ->where("type = 'logo'")
            ->execute('Option');

        $favicon = Query::from('cmspf_Options')
            ->where("type = 'favicon'")
            ->execute('Option');
        if (isset($this->data) && isset($this->template)) {
            include "View/" . $this->template . ".tpl.php";
        }else{
            include "View/" .$this->view.".view.php";
        }
    }

}