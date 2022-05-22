<?php

namespace App\Model;

class ComponentTranslation
{
    public $id = null;
    protected $type;
    protected $component_key;
    protected $translation_key;


    public function __construct()
    {
        parent::__construct();
    }

    public function save()
    {
        parent::save();
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
    public function getComponentKey()
    {
        return $this->component_key;
    }

    /**
     * @param mixed $component_key
     */
    public function setComponentKey($component_key): void
    {
        $this->component_key = $component_key;
    }

    /**
     * @return mixed
     */
    public function getTranslationKey()
    {
        return $this->translation_key;
    }

    /**
     * @param mixed $translation_key
     */
    public function setTranslationKey($translation_key): void
    {
        $this->translation_key = $translation_key;
    }

}