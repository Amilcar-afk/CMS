<?php
namespace App\Model;

use App\Core\BaseSQL;

class Rdv extends BaseSQL
{
    protected $id = null;
    protected $title;
    protected $startDate;
    protected $endDate;
    protected $status;
    protected $location;
    protected $description;
    protected $rdv_step_key;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of startDate
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */ 
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of endDate
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */ 
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of rdv_step_key
     */ 
    public function getRdv_step_key()
    {
        return $this->rdv_step_key;
    }

    /**
     * Set the value of rdv_step_key
     *
     * @return  self
     */ 
    public function setRdv_step_key($rdv_step_key)
    {
        $this->rdv_step_key = $rdv_step_key;

        return $this;
    }

    public function save()
    {
        parent::save();
    }

    public function loadCalendar ($sql)
    {
        return parent::findAllData($sql);

    }

    public function deleteEvent ($params)
    {
        return parent::delete($params);

    }

    public function selectOneByData(string $sql, $params){

        return parent::findOneData($sql, $params);
    }

    public function selectAllData(string $sql ){

        return parent::findAllData($sql);
    }

    public function getPramsFromUri(){

        return parent::getPramsFromUri();
    }

  

    public function getFormRegister(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"reserver",
            ],
            "select"=>[
                "title"=>[
                    "type"=>"select",
                    "name"=>"title",
                    "option"=>[
                        "libre",
                        "devis",
                        "autre option",
                    ],
                    "required"=>true,
                    "placeholder"=>"le titre ...",
                    "id"=>"title",
                    "class"=>"inputRegister",
                    "required"=>true,
                    "error"=>"titre incorrect",
                ],

            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "label"=>"id",

                    "id"=>"id",
                    "class"=>"inputRegister",
                    "value"=> $this->getId(),

                    
                    ],
              
                "location"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre location ...",
                    "label"=>"location",
                    "id"=>"location",
                    "class"=>"location",
                    "required"=>true,
                    "error"=>"location incorrect",
                    "unicity"=>true,
                    "value"=> $this->getLocation(),
                ],
            ],
            "textarea"=>[
                "description"=>[
                    "type"=>"text",
                    "placeholder"=>"description ...",
                    "id"=>"description",
                    "class"=>"description",
                    "min"=>2,
                    "max"=>50,
                    "name"=>"description",
                    "error"=>"champ ",
                    "value"=> $this->getDescription(),
                ]

            ]
        ];
    }
}