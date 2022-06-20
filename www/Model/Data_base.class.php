<?php
namespace App\Model;

use App\Core\BaseSQL;

class Data_base extends BaseSQL
{
    protected $id = null;
    protected $host_name;
    protected $password;
    protected $port;
    protected $db_name;


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
     * Get the value of host_name
     */ 
    public function getHost_name()
    {
        return $this->host_name;
    }

    /**
     * Set the value of host_name
     *
     * @return  self
     */ 
    public function setHost_name($host_name)
    {
        $this->host_name = $host_name;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of port
     */ 
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set the value of port
     *
     * @return  self
     */ 
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    public function dataBaseForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "cta"=>"cta-button-compose-database",
                "submit"=>"SAVE",
            ],
            "inputs"=>[
                "host_name"=>[
                    "type"=>"text",
                    "placeholder"=>"Host Name ...",
                    "name"=>"host_name",
                    "id"=>"host_name",
                    "class"=>"input",
                    "question"=>"Host Name",
                    "value"=> $this->getHost_name(),
                    "required"=>true,
                    "min"=>2,
                    "max"=>50,
                    "error"=>""

                    ],

                "db_name"=>[
                    "type"=>"text",
                    "placeholder"=>"DB name ...",
                    "name"=>"db_name",
                    "question"=>"DB name ",
                    "id"=>"db_name",
                    "class"=>"input",
                    "required"=>true,
                    "value"=> $this->getDb_name(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Password ...",
                    "name"=>"password",
                    "question"=>"Password",
                    "id"=>"password",
                    "class"=>"input",
                    "required"=>true,
                    "value"=> $this->getPassword(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "port"=>[
                    "type"=>"text",
                    "placeholder"=>"Port ...",
                    "name"=>"port",
                    "question"=>"Port",
                    "id"=>"port",
                    "class"=>"input",
                    "value"=> $this->getPort(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],
            ],
            
        ];
    }


    /**
     * Get the value of db_name
     */ 
    public function getDb_name()
    {
        return $this->db_name;
    }

    /**
     * Set the value of db_name
     *
     * @return  self
     */ 
    public function setDb_name($db_name)
    {
        $this->db_name = $db_name;

        return $this;
    }
}