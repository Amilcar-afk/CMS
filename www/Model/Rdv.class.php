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

    public function delete($id)
    {
        parent::delete($id);
    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

    public function getFormNewSlot(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"reserver",
            ],
            "inputs"=>[
                "start"=>[
                    "type"=>"date",
                    "label"=>"",
                    "id"=>"start",
                    "class"=>"inputRegister",
                    "value"=> $this->getStartDate(),
                    "error"=>""
                    ],
                "end"=>[
                    "type"=>"date",
                    "label"=>"",
                    "id"=>"id",
                    "class"=>"inputRegister",
                    "value"=> $this->getEndDate(),
                    "error"=>""
                    ],
            ],
            
        ];
    }

    public function getFormUpdateSlot(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"reserver",
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "question"=>"",
                    "name"=>"id",
                    "class"=>"input",
                    "value"=> $this->getId(),
                    "error"=>""
                    ],
                "start"=>[
                    "type"=>"date",
                    "label"=>"",
                    "id"=>"start",
                    "class"=>"inputRegister",
                    "value"=> $this->getStartDate(),
                    "error"=>""
                    ],
                "end"=>[
                    "type"=>"date",
                    "label"=>"",
                    "id"=>"id",
                    "class"=>"inputRegister",
                    "value"=> $this->getEndDate(),
                    "error"=>""
                    ],
            ],
            
        ];
    }


    public function getFormNewMeeting(): array
    {
        return [
            "config"=>[
                "submit"=>"Save",
                "cta"=>"cta-button-compose-rdv",
                "method"=>"POST",
                
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "question"=>"",
                    "name"=>"id",
                    "class"=>"input",
                    "value"=> $this->getId(),
                    "error"=>""
                    ],

                "title"=>[
                    "type"=>"text",
                    "placeholder"=>"Meeting title ...",
                    "name"=>"title",
                    "question"=>"Title",
                    "id"=>"title",
                    "class"=>"input",
                    "required"=>true,
                    "min"=>2,
                    "max"=>50,
                    "value"=> $this->getTitle(),
                    "error"=>""
                ],
              
                "location"=>[
                    "type"=>"text",
                    "placeholder"=>"Meeting location ...",
                    "name"=>"location",
                    "question"=>"Location",
                    "class"=>"input",
                    "min"=>2,
                    "max"=>50,
                    "required"=>true,
                    "value"=> $this->getLocation(),
                    "error"=>""
                ],

                "description"=>[
                    "type"=>"textarea",
                    "placeholder"=>"Meeting description ...",
                    "class"=>"input",
                    "question"=>"Description",
                    "id"=>"description_form",
                    "min"=>2,
                    "max"=>50,
                    "rows"=>4,
                    "cols"=>10,
                    "name"=>"description",
                    "value"=> $this->getDescription(),
                    "error"=>""
                ]
            ],
            
        ];
    }
}