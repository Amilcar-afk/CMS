<?php
namespace App\Model;

use App\Core\BaseSQL;

class User_rdv extends BaseSQL
{






    
    protected $id = null;
    protected $table_name = 'User_rdv';
    protected $type;
    protected $user_key;
    protected $rdv_key;

    public function __construct()
    {
        parent::__construct();
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

    /**
     * Get the value of user_key
     */ 
    public function getUser_key()
    {
        return $this->user_key;
    }

    /**
     * Set the value of user_key
     *
     * @return  self
     */ 
    public function setUser_key($user_key)
    {
        $this->user_key = $user_key;

        return $this;
    }

    /**
     * Get the value of rdv_key
     */ 
    public function getRdv_key()
    {
        return $this->rdv_key;
    }

    /**
     * Set the value of rdv_key
     *
     * @return  self
     */ 
    public function setRdv_key($rdv_key)
    {
        $this->rdv_key = $rdv_key;

        return $this;
    }
    public function save()
    {
        parent::save();
    }

   

}

   