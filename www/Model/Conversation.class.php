<?php


namespace App\Model;
use App\Core\BaseSQL;
use App\Core\Query;
use App\Model\User_conversation;



class Conversation extends BaseSQL
{
    public $id = null;
    public $date;

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

    public function save()
    {
        parent::save();
    }

    public function getLastId()
    {
        return parent::getLastId();
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

    public function users()
    {
        return parent::belongsToMany(User::class, 'cmspf_User_conversation');
    }

    public function messages()
    {
        return parent::hasMany(Message::class, 'conversation_key');
    }

    public function lastMessage()
    {

        return Query::from('cmspf_Messages')->where('conversation_key = '.$this->getId())->orderby("id","DESC")->limit('1')->execute('Message');

    }



    // (SELECT max(id) FROM cmspf_Messages) 



}