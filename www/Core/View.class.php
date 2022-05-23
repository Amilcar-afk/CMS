<?php

namespace App\Core;

class View
{
    private $view;
    private $template;
    private $data = [];
    private $array = [];

    public function __construct($view, $template = "front")
    {
        $this->setView($view);
        $this->setTemplate($template);
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
        extract($this->data);//array(2) { ["firstname"]=> string(8) "Marouane" ["lastname"]=> string(5) "Talbi" } 
        include "View/".$this->template.".tpl.php";
    }

}