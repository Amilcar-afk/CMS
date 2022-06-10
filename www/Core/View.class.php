<?php

namespace App\Core;

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

    public function includePartial($name, $config)
    {
        if(!file_exists("View/Partial/".$name.".partial.php"))
        {
            die("partial ".$name." 404");
        }
        include "View/Partial/".$name.".partial.php";
    }
    

    public function __destruct()
    {
        extract($this->data);
        if (isset($this->data) && isset($this->template)) {
            include "View/" . $this->template . ".tpl.php";
        }else{
            include "View/" .$this->view.".view.php";
        }
    }

}