<?php

namespace App\Model;

class Translation
{
    public $id = null;
    protected $content;
    protected $language_key;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getLanguageKey()
    {
        return $this->language_key;
    }

    /**
     * @param mixed $language_key
     */
    public function setLanguageKey($language_key): void
    {
        $this->language_key = $language_key;
    }
}