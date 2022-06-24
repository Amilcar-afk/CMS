<?php


namespace App\Model;

use App\Core\BaseSQL;


class Project extends BaseSQL
{
    protected $id = null;
    protected $user_key = null;
    protected $page_key = null;
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
    
    public function save()
    {
        parent::save();
    }

    public function delete($id)
    {
        return parent::delete($id);

    }
}