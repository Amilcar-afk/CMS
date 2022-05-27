<?php


namespace App\Model;

use App\Core\BaseSQL;


class Categorie extends BaseSQL
{
    public $id = null;
    protected $type;
  

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
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function save()
    {
        parent::save();
    }

    public function deleteCategorie ($params)
    {
        return parent::delete($params);

    }

    public function getCategorieForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"reserver",
            ],
 
            "inputs"=>[
     
                "type"=>[
                    "type"=>"select",
                    "question"=>"nav",
                    "choice"=>[
                        [
                            "id"=>"",
                            "value"=>"nav",
                            "class"=>"",
                        ],
                        [
                            "id"=>"",
                            "value"=>"tag",
                            "class"=>"",
                        ],
                        
                    ],
                    "placeholder"=>"Le type ...",
                    "label"=>"type",
                    "id"=>"type",
                    "class"=>"type",
                    "required"=>true,
                    "error"=>"type incorrect",
                    "unicity"=>true,
                ],
            ],
            
        ];
    }
}