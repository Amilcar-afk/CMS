<?php


namespace App\Model;

use App\Core\BaseSQL;


class User_conversation extends BaseSQL
{
    protected $id = null;
    protected $table_name = 'cmspf_User_conversation';
    public $user_key = null;
    public $conversation_key = null;

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
     * Get the value of conversation_key
     */ 
    public function getConversation_key()
    {
        return $this->conversation_key;
    }

    /**
     * Set the value of conversation_key
     *
     * @return  self
     */ 
    public function setConversation_key($conversation_key)
    {
        $this->conversation_key = $conversation_key;

        return $this;
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