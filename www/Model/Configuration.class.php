<?php
namespace App\Model;

use App\Core\BaseSQL;

class Configuration extends BaseSQL
{
    protected $id = null;
    protected $host_name = null;
    protected $password= null;
    protected $port = null;
    protected $db_name = null;
    protected $db_user = null;
    protected $site_name = null;


    protected $smtp_host;
    protected $smtp_auth;
    protected $smtp_secure;
    protected $smtp_username;
    protected $smtp_password;
    protected $smtp_port;



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
     * Get the value of site_name
     */ 
    public function getSite_name()
    {
        return $this->site_name;
    }

    /**
     * Set the value of site_name
     *
     * @return  self
     */ 
    public function setSite_name($site_name)
    {
        $this->site_name = $site_name;

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

    /**
     * Get the value of smtp_host
     */
    public function getSmtp_host()
    {
        return $this->smtp_host;
    }

    /**
     * Set the value of smtp_host
     *
     * @return  self
     */
    public function setSmtp_host($smtp_host)
    {
        $this->smtp_host = $smtp_host;

        return $this;
    }

    /**
     * Get the value of smtp_auth
     */
    public function getSmtp_auth()
    {
        return $this->smtp_auth;
    }

    /**
     * Set the value of smtp_auth
     *
     * @return  self
     */
    public function setSmtp_auth($smtp_auth)
    {
        $this->smtp_auth = $smtp_auth;

        return $this;
    }

    /**
     * Get the value of smtp_secure
     */
    public function getSmtp_secure()
    {
        return $this->smtp_secure;
    }

    /**
     * Set the value of smtp_secure
     *
     * @return  self
     */
    public function setSmtp_secure($smtp_secure)
    {
        $this->smtp_secure = $smtp_secure;

        return $this;
    }

    /**
     * Get the value of smtp_username
     */
    public function getSmtp_username()
    {
        return $this->smtp_username;
    }

    /**
     * Set the value of smtp_username
     *
     * @return  self
     */
    public function setSmtp_username($smtp_username)
    {
        $this->smtp_username = $smtp_username;

        return $this;
    }

    /**
     * Get the value of smtp_password
     */
    public function getSmtp_password()
    {
        return $this->smtp_password;
    }

    /**
     * Set the value of smtp_password
     *
     * @return  self
     */
    public function setSmtp_password($smtp_password)
    {
        $this->smtp_password = $smtp_password;

        return $this;
    }

    /**
     * Get the value of smtp_port
     */
    public function getSmtp_port()
    {
        return $this->smtp_port;
    }

    /**
     * Set the value of smtp_port
     *
     * @return  self
     */
    public function setSmtp_port($smtp_port)
    {
        $this->smtp_port = $smtp_port;

        return $this;
    }

    /**
     * Get the value of root
     */
    public function getDb_user()
    {
        return $this->db_user;
    }

    /**
     * Set the value of root
     *
     * @return  self
     */
    public function setDb_user($db_user)
    {
        $this->db_user = $db_user;

        return $this;
    }

    public function insertDatabase()
    {
        parent::insertDatabase();
    }

    public function dataBaseForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "cta"=>"cta-button-compose-database",
                "submit"=>"Save",
            ],
            "inputs"=>[

                "DBHOST"=>[
                    "type"=>"text",
                    "placeholder"=>"Host Name ...",
                    "name"=>"DBHOST",
                    "id"=>"host_name",
                    "class"=>"input",
                    "question"=>"Host Name",
                    "value"=> $this->getHost_name(),
                    "required"=>true,
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],
                    
                "SITENAME"=>[
                    "type"=>"text",
                    "placeholder"=>"Site Name ...",
                    "name"=>"SITENAME",
                    "id"=>"site_name",
                    "class"=>"input",
                    "question"=>"Site Name",
                    "value"=> $this->getSite_name(),
                    "required"=>true,
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "DBNAME"=>[
                    "type"=>"text",
                    "placeholder"=>"DB name ...",
                    "name"=>"DBNAME",
                    "question"=>"DB name ",
                    "id"=>"db_name",
                    "class"=>"input",
                    "required"=>true,
                    "value"=> $this->getDb_name(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "DBUSER"=>[
                    "type"=>"text",
                    "placeholder"=>"User...",
                    "name"=>"DBUSER",
                    "question"=>"User",
                    "id"=>"db_user",
                    "class"=>"input",
                    "value"=> $this->getDb_user(),
                    "required"=>true,
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                ],

                "DBPWD"=>[
                    "type"=>"password",
                    "placeholder"=>"Password ...",
                    "name"=>"DBPWD",
                    "question"=>"Password",
                    "id"=>"password",
                    "class"=>"input",
                    "required"=>true,
                    "value"=> $this->getPassword(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "DBPORT"=>[
                    "type"=>"text",
                    "placeholder"=>"Port ...",
                    "name"=>"DBPORT",
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

    public function smtpForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "cta"=>"cta-button-compose-smtp",
                "submit"=>"Save",
            ],
            "inputs"=>[
                "SMTP_HOST"=>[
                    "type"=>"text",
                    "placeholder"=>"SMTP Host ...",
                    "name"=>"SMTP_HOST",
                    "question"=>"SMTP Host",
                    "id"=>"smtp_host",
                    "class"=>"input",
                    "required"=>true,
                    "value"=> $this->getSmtp_host(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "SMTP_PORT"=>[
                    "type"=>"text",
                    "placeholder"=>"SMTP Port ...",
                    "name"=>"SMTP_PORT",
                    "question"=>"SMTP Port",
                    "id"=>"smtp_port",
                    "class"=>"input",
                    "value"=> $this->getSmtp_port(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "SMTP_SECURE"=>[
                    "type"=>"text",
                    "placeholder"=>"SMTP Secure ...",
                    "name"=>"SMTP_SECURE",
                    "question"=>"SMTP Secure",
                    "id"=>"smtp_secure",
                    "class"=>"input",
                    "value"=> $this->getSmtp_secure(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "SMTP_USERNAME"=>[
                    "type"=>"text",
                    "placeholder"=>"SMTP Email ...",
                    "name"=>"SMTP_USERNAME",
                    "question"=>"SMTP Username",
                    "id"=>"smtp_username",
                    "class"=>"input",
                    "value"=> $this->getSmtp_username(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

                "SMTP_PASSWORD"=>[
                    "type"=>"text",
                    "placeholder"=>"SMTP Password ...",
                    "name"=>"SMTP_PASSWORD",
                    "question"=>"SMTP Password",
                    "id"=>"smtp_password",
                    "class"=>"input",
                    "value"=> $this->getSmtp_password(),
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                    ],

            ],
            
        ];
    }
}