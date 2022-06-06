<?php
namespace App\Model;

use App\Core\BaseSQL;

class User extends BaseSQL
{

    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $mail;
    protected $pwd;
    protected $pwd1;
    protected $pwd2;
    protected $creationDate;
    protected $updateDate;
    protected $token;
    protected $rank;
    protected $try;
    protected $confirmKey;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     */
    public function setPwd($pwd): void
    {
        $this->pwd = $pwd;
    }

    /**
     * @return mixed
     */
    public function getId(): ? int

    {
        return $this->id;
    }

    // /**
    //  * @param mixed $id
    //  */
    // public function setId($id): void
    // {
    //     $this->id = $id;
    // }

    /**
     * @return mixed
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param mixed $email
     */
    public function setMail($email): void
    {
        $this->mail = strtolower(trim($email));
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->pwd;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->pwd = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return mixed
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param null
     * Token char 32
     */
    public function generateToken(): void
    {
        $this->token = str_shuffle(md5(uniqid()));
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
     * Get the value of passwordOldFirst
     */ 
    public function getPasswordOldFirst()
    {
        return $this->pwd1;
    }

    /**
     * Set the value of passwordOldFirst
     *
     * @return  self
     */ 
    public function setPasswordOldFirst($passwordOldFirst)
    {
        $this->pwd1 = $passwordOldFirst;

        return $this;
    }

    /**
     * Get the value of passwordOldSecond
     */ 
    public function getPasswordOldSecond()
    {
        return $this->pwd2;
    }

    /**
     * Set the value of passwordOldSecond
     *
     * @return  self
     */ 
    public function setPasswordOldSecond($passwordOldSecond)
    {
        $this->pwd2 = $passwordOldSecond;

        return $this;
    }

    /**
     * Get the value of creationDate
     */ 
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of updateDate
     */ 
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set the value of updateDate
     *
     * @return  self
     */ 
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get the value of rank
     */ 
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set the value of rank
     *
     * @return  self
     */ 
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get the value of try
     */ 
    public function getTry()
    {
        return $this->try;
    }

    /**
     * Set the value of try
     *
     * @return  self
     */ 
    public function setTry($try)
    {
        $this->try = $try;

        return $this;
    }

    /**
     * Get the value of confirmKey
     */ 
    public function getConfirmKey()
    {
        return $this->confirmKey;
    }

    /**
     * Set the value of confirmKey
     *
     * @return  self
     */ 
    public function setConfirmKey($confirmKey)
    {
        $this->confirmKey = $confirmKey;

        return $this;
    }
    
    public function getFormRegister(): array
    {

            return [
                "config"=>[
                    "method"=>"POST",
                    "action"=>"",
                    "submit"=>"S'inscrire",
                    "selectename"=>"pays"
                ],
                "inputs"=>[
                        "email"=>[
                            "question"=>"Email",
                            "type"=>"email",
                            "placeholder"=>"Your email",
                            "name"=>"emailRegister",
                            "class"=>"input",
                            "required"=>true,
                            "error"=>"",
                            "unicity"=>true,
                            "min"=>10,
                            "max"=>255,
                            "errorUnicity"=>"Email existe déjà en bdd"
                        ],
                        "password"=>[
                            "question"=>"Password",
                            "type"=>"password",
                            "placeholder"=>"Your password",
                            "name"=>"pwdRegister",
                            "class"=>"input",
                            "required"=>true,
                            "min"=>12,
                            "max"=>60,
                            "error"=>"",
                        ],
                        "passwordConfirm"=>[
                            "question"=>"Confirm password",
                            "type"=>"password",
                            "placeholder"=>"Confirm password",
                            "name"=>"pwdConfirmRegister",
                            "class"=>"input",
                            "required"=>true,
                            "confirm"=>"password",
                            "error"=>"",
                        ],
                        "firstname"=>[
                            "question"=>"Fisrtname",
                            "type"=>"text",
                            "placeholder"=>"your Fisrtname",
                            "name"=>"firstnameRegister",
                            "class"=>"input",
                            "min"=>2,
                            "max"=>50,
                            "error"=>"",
                        ],
                        "lastname"=>[
                            "question"=>"Lastname",
                            "type"=>"text",
                            "placeholder"=>"Your lastname",
                            "name"=>"lastnameRegister",
                            "class"=>"input",
                            "min"=>2,
                            "max"=>100,
                            "error"=>"",
                        ],
                    ],
            ];
    }


    public function getFormLogin(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Login"
            ],
            "inputs"=>[
                "email"=>[
                    "question"=>"Mail",
                    "type"=>"email",
                    "placeholder"=>"Your mail",
                    "name"=>"emailRegister",
                    "class"=>"input",
                    "required"=>true,
                ],
                "password"=>[
                    "question"=>"Password",
                    "type"=>"password",
                    "placeholder"=>"Your password",
                    "name"=>"pwdRegister",
                    "class"=>"input",
                    "required"=>true,
                ]
            ]

        ];
    }
}

