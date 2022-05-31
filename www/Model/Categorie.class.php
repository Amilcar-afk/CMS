<?php


namespace App\Model;
use Page;
use App\Core\BaseSQL;

use App\Core\Query;


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

    public function pages()
    {
        return parent::belongsToMany(Page::class, 'cmspf_Page_categorie');
    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }


    public function getFormNewCategorie(): array
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