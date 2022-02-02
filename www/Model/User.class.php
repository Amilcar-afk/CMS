<?php
namespace App\Model;

use App\Core\BaseSQL;

class User extends BaseSQL
{

    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $passwordOldFirst;
    protected $passwordOldSecond;
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
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


 


    /**
     * Get the value of passwordOldFirst
     */ 
    public function getPasswordOldFirst()
    {
        return $this->passwordOldFirst;
    }

    /**
     * Set the value of passwordOldFirst
     *
     * @return  self
     */ 
    public function setPasswordOldFirst($passwordOldFirst)
    {
        $this->passwordOldFirst = $passwordOldFirst;

        return $this;
    }

    /**
     * Get the value of passwordOldSecond
     */ 
    public function getPasswordOldSecond()
    {
        return $this->passwordOldSecond;
    }

    /**
     * Set the value of passwordOldSecond
     *
     * @return  self
     */ 
    public function setPasswordOldSecond($passwordOldSecond)
    {
        $this->passwordOldSecond = $passwordOldSecond;

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
                        "type"=>"email",
                        "placeholder"=>"Votre email ...",
                        "id"=>"emailRegister",
                        "class"=>"inputRegister",
                        "required"=>true,
                        "error"=>"Email incorrect",
                        "unicity"=>true,
                        "errorUnicity"=>"Email existe déjà en bdd"
                    ],
                    "password"=>[
                        "type"=>"password",
                        "placeholder"=>"Votre mot de passe ...",
                        "id"=>"pwdRegister",
                        "class"=>"inputRegister",
                        "required"=>true,
                        "error"=>"Votre mot de passe doit faire entre 8 et 16 et contenir des chiffres et des lettres",
                    ],
                    "passwordConfirm"=>[
                        "type"=>"password",
                        "placeholder"=>"Confirmation ...",
                        "id"=>"pwdConfirmRegister",
                        "class"=>"inputRegister",
                        "required"=>true,
                        "confirm"=>"password",
                        "error"=>"Votre mot de passe de confirmation ne correspond pas",
                    ],
                    "firstname"=>[
                        "type"=>"text",
                        "placeholder"=>"Prénom ...",
                        "id"=>"firstnameRegister",
                        "class"=>"inputRegister",
                        "min"=>2,
                        "max"=>50,
                        "error"=>"Votre prénom n'est pas correct",
                    ],
                    "lastname"=>[
                        "type"=>"text",
                        "placeholder"=>"Nom ...",
                        "id"=>"lastnameRegister",
                        "class"=>"inputRegister",
                        "min"=>2,
                        "max"=>100,
                        "error"=>"Votre nom n'est pas correct",
                    ],
                    "uploader"=>[
                        "type"=>"file",
                        "placeholder"=>"chiosir un fichier ...",
                        "id"=>"lastnameRegister",
                        "class"=>"inputRegister",
                        "name"=>"upload",
                        "accept"=>"image/png, image/jpeg",
                        "error"=>"Votre nom n'est pas correct",
                    ],
                ],

            "select"=>[
                "option"=>[
                    "value"=>"france",
                    "name"=>"France",
                    "id"=>"optionRegister",
                    "class"=>"inputRegister",
                    "selected"=>"selected"
                ],
                "option1"=>[
                    "value"=>"espagne",
                    "name"=>"Espagne",
                    "id"=>"optionRegister",
                    "class"=>"optionRegister",
                ],
                "option2"=>[
                    "value"=>"italy",
                    "name"=>"Italy",
                    "id"=>"optionRegister",
                    "class"=>"optionRegister",
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
                "submit"=>"Se connecter"
            ],
            "inputs"=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "id"=>"emailRegister",
                    "class"=>"inputRegister",
                    "required"=>true,
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "id"=>"pwdRegister",
                    "class"=>"inputRegister",
                    "required"=>true,
                ]
            ]

        ];
    }
    public function getFormTp(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Se connecter"
            ],


        ];
    }
}

