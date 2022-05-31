<?php


namespace App\Model;

use App\Core\BaseSQL;


class Categorie extends BaseSQL
{
    public $id = null;
    protected $type;
    protected $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
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

    public function getAllCategories($sql)
    {
        return parent::findAllData($sql);

    }

    // public function getCategorie()
    // {
    //     return parent::find();
    // }

    // public function getCategories($id)
    // {
    //     return parent::find($id);
    // }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }



    public function categorieUpdateForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"valider",
            ],
 
            "inputs"=>[

                "id"=>[
                    "type"=>"hidden",
                    "label"=>"",
                    "id"=>"id",
                    "placeholder"=>"",
                    "question"=>"",
                    "class"=>"inputRegister",
                    "value"=> $this->getId(),
                    ],
                "type"=>[
                    "type"=>"text",
                    "label"=>"type",
                    "question"=>"",
                    "placeholder"=>"",
                    "id"=>"type",
                    "class"=>"type",
                    "required"=>true,
                    "value"=> $this->getType(),
                ],
            ]
        ];
    }

    public function getCategorieForm (): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"valider",
            ],
 
            "inputs"=>[
     
                "type"=>[
                    "type"=>"select",
                    "question"=>"nav",
                    "choices"=>[
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