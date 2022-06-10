<?php
namespace App\Model;

use App\Core\BaseSQL;
use Page;

class Stats extends BaseSQL
{

    protected $id = null;
    protected $date;
    protected $country;
    protected $reseau_soc_key;
    protected $page_key;
    protected $ip;
    protected $type;
    protected $table_name = 'Stats';

    public function __construct()
    {
        parent::__construct();
    }

    public function loadStats()
    {
        return parent::find();
    }
    public function getPageName()
    {
        return parent::belongsTo(Page::class, 'page_key', 'title');
    }
    /**
     * @return mixed
     */
    public function getId()

    {
        return $this->id;
    }

    /**
      * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $email
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param mixed $password
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReseauSocKey()
    {
        return $this->reseau_soc_key;
    }

    /**
     * @param mixed $firstname
     */
    public function setReseauSocKey($reseau_soc_key)
    {
        $this->reseau_soc_key = $reseau_soc_key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageKey()
    {
        return $this->page_key;
    }

    /**
     * @param mixed $lastname
     */
    public function setPageKey($page_key)
    {
        $this->page_key = $page_key;
        return $this;
    }

    /**
     * @return null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param null
     * Token char 32
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getDevice()
    {
        return $this->device;
    }

    public function setDevice($device)
    {
        $this->device = $device;
        return $this;
    }


    public function save()
    {
        parent::save();
    }

    public function select($sql, $param){
        parent::findOneData($sql, $param);
    }
    
}

