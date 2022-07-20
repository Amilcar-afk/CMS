<?php


namespace App\Model;

use App\Core\BaseSQL;
use Cassandra\Date;


class Step extends BaseSQL
{
    protected $id = null;
    protected $user_key = null;
    protected $projet_key = null;
    protected $title;
    protected $description;
    protected $date;

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
     * @return mixed
     */
    public function getDescription(): ? string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
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

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getDate(): ? \DateTime
    {
        $date = new \DateTime($this->date);
        return $date;
    }

    public function getUserKey(): ? int
    {
        return $this->user_key;
    }

    public function setUserKey($id)
    {
        $this->user_key = $id;
        return $this;
    }

    public function getProjectKey(): ? int
    {
        return $this->projet_key;
    }

    public function setProjectKey($id)
    {
        $this->projet_key = $id;
        return $this;
    }

    public function save()
    {
        parent::save();
    }

    public function delete($id)
    {
        return parent::delete($id);

    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

    public function getAllStepsFromProject($id)
    {
        return $this->find($id);
    }

    public function getFormStep($name = ''){
        return [
            "config"=>[
                "method"=>"POST",
                "submit"=>"Save",
                "id"=>"formNewStep",
                "idButton"=>"buttonSaveStep".$name,
                "cta"=>"cta-button-compose-step"
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
                ],
                "description"=>[
                    "question"=>"step description",
                    "placeholder"=>"description",
                    "type"=>"textarea",
                    "name"=>"description",
                    "value"=>$this->getDescription(),
                    "class"=>"input",
                    "rows"=>16,
                    "min"=>3,
                    "max"=>140,
                    "cols"=>"",
                    "error"=>""
                ],
            ],
        ];
    }
}