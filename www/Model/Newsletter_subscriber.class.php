<?php

namespace App\Model;


use App\Core\BaseSQL;
use App\Core\Query;
use App\Model\Newsletter;

class Newsletter_subscriber extends BaseSQL
{
    public $id = null;
    protected $email;
    protected $user_key;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId(): ? int
    {
        return $this->id;
    }

    public function setId($id): object
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUserKey(): ? string
    {
        return $this->user_key;
    }

    /**
     * @param mixed $title
     */
    public function setUserKey($user_key): void
    {
        $this->user_key = $user_key;
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    public function save()
    {
        parent::save();
    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

}