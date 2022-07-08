<?php


namespace App\Model;

use App\Core\BaseSQL;
use App\Core\Query;

class User_conversation extends BaseSQL
{
    protected $id = null;
    protected $table_name = 'cmspf_User_conversation';
    public $user_key = null;
    public $conversation_key = null;
    public $seen;


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


    /**
     * Get the value of seen
     */ 
    public function getSeen()
    {
        return $this->seen;
    }

    /**
     * Set the value of seen
     *
     * @return  self
     */ 
    public function setSeen($seen)
    {
        $this->seen = $seen;

        return $this;
    }


    public function getUser_Conversation($id)
    {
        $getUser_Conversation = Query::from('cmspf_User_conversation')
        ->where('conversation_key = '.$id)
        ->where('user_key = '.$_SESSION['Auth']->id)
        ->execute('User_conversation');
        return $getUser_Conversation ;
    }




}