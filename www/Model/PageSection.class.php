<?php


namespace App\Model;


class PageSection
{
    protected $id = null;
    protected $page_key;

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
    public function getPageKey()
    {
        return $this->page_key;
    }

    /**
     * @param mixed $page_key
     */
    public function setPageKey($page_key): void
    {
        $this->page_key = $page_key;
    }

    /**
     * @return mixed
     */
    public function getSectionKey()
    {
        return $this->section_key;
    }

    /**
     * @param mixed $section_key
     */
    public function setSectionKey($section_key): void
    {
        $this->section_key = $section_key;
    }
    protected $section_key;
}