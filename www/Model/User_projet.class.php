<?php


namespace App\Model;

use App\Core\BaseSQL;


class Projet extends BaseSQL
{
    protected $id = null;
    protected $user_key = null;
    protected $project_key = null;
    protected $type;

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

    public function getUserKey(): ? int
    {
        return $this->user_key;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): ? int
    {
        return $this->type;
    }

    public function setUserKey($id)
    {
        $this->user_key = $id;
        return $this;
    }

    public function getProjectKey(): ? int
    {
        return $this->page_key;
    }

    public function setProjectKey($id)
    {
        $this->page_key = $id;
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


}