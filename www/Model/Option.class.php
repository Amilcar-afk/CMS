<?php
namespace App\Model;

use App\Core\BaseSQL;

class Option extends BaseSQL
{
    protected $id = null;
    protected $type;
    protected $path;
    protected $value;
    protected $user_key;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getUserKey()
    {
        return $this->user_key;
    }

    /**
     * @param mixed $user_key
     */
    public function setUserKey($user_key): void
    {
        $this->user_key = $user_key;
    }

    public function save()
    {
        parent::save();
    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    public function getFormNewFont(): array
    {

        return [
            "config"=>[
                "method"=>"POST",
                "submit"=>"Save",
                "cta"=>"cta-button-compose-page"
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "name"=>"id",
                    "class"=>"input",
                    "value"=>$this->getId(),
                    "error"=>""
                ],
                "type"=>[
                    "type"=>"hidden",
                    "name"=>"type",
                    "class"=>"input",
                    "value"=>$this->getType(),
                    "error"=>""
                ],
                "font"=>[
                    "question"=>"Font file",
                    "type"=>"file",
                    "name"=>"font",
                    "class"=>"input",
                    "value"=>$this->getPath(),
                    "error"=>""
                ],
                "default"=>[
                    "question"=>"Default Font",
                    "type"=>"checkbox",
                    "name"=>"default",
                    "class"=>"input",
                    "value"=>$this->getDefault(),
                    "error"=>""
                ],
            ]

        ];
    }

}

   