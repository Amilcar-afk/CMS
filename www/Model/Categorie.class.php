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
    public function getTitle(): ? string
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
    public function getId(): ? int
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

    public function delete($params)
    {
        return parent::delete($params);

    }

    public function pages()
    {
        return parent::belongsToMany(Page::class, 'cmspf_Page_categorie');
    }

    public function navigations()
    {
        return parent::belongsToMany(Categorie::class, 'cmspf_Categorie_categorie', 'id', 'id', 'categorie_child_key', 'categorie_parent_key');
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
                "submit"=>"valider",
                "cta"=>"cta-button-compose-categorie"
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "name"=>"id",
                    "class"=>"input",
                    "value"=>$this->getId(),
                    "error"=>""
                ],
                "title"=>[
                    "question"=>"Title",
                    "type"=>"text",
                    "placeholder"=>"Title",
                    "name"=>"title",
                    "class"=>"input",
                    "required"=>true,
                    "min"=>3,
                    "max"=>30,
                    "value"=>$this->getTitle(),
                    "error"=>""
                ]
            ],
            
        ];
    }
}