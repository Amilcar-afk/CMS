<?php


namespace App\Model;
use App\Core\BaseSQL;
use App\Model\User;


class Message extends BaseSQL
{
    public $id = null;
    public $date;
    public $publish;
    public $content;
    public $type;
    public $user_key;
    public $conversation_key;



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
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of publish
     */ 
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Set the value of publish
     *
     * @return  self
     */ 
    public function setPublish($publish)
    {
        $this->publish = $publish;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

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

    public function user()
    {
       return parent::belongsTo(User::class, $this->getUser_key());
    }
    







}