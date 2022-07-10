<?php

namespace App\Model;

use App\Controller\Statistics;
use App\Core\BaseSQL;
use App\Core\Query;
use App\Model\Categorie;
use App\Model\Reseaux_soc;

class Newsletter extends BaseSQL
{
    public $id = null;
    protected $date_update;
    protected $date_release;
    protected $title;
    protected $status;
    protected $user_key;
    protected $content;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return json_decode($this->content, true);
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function __construct()
    {
        parent::__construct();
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
     * @return mixed
     */
    public function getUserKey()
    {
        return $this->user_key;
    }

    /**
     * @param mixed $user_key
     */
    public function setUserKey($user_key): void
    {
        $this->user_key = $user_key;
    }

    /**
     * @return null
     */
    public function getId(): ? int
    {
        return $this->id;
    }

    public function setId($id): object
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->date_update;
    }

    /**
     * @param mixed $dateUpdate
     */
    public function setDateUpdate($dateUpdate): void
    {
        $this->date_update = $dateUpdate;
    }

    /**
     * @return mixed
     */
    public function getTitle(): ? string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getStatus(): ? string
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    /**
     * @return mixed
     */
    public function getDateRelease()
    {
        return $this->date_release;
    }

    /**
     * @param mixed $date_release
     */
    public function setDateRelease($date_release): void
    {
        $this->date_release = $date_release;
    }

    public function getFormNewNewsletter(): array
    {

        return [
            "config"=>[
                "method"=>"POST",
                "submit"=>"Save",
                "cta"=>"cta-button-compose-newsletter"
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "name"=>"id",
                    "class"=>"input",
                    "value"=>$this->getId(),
                    "error"=>""
                ],
                "title"=>[
                    "question"=>"Title",
                    "type"=>"text",
                    "placeholder"=>"Newsletter title",
                    "name"=>"title",
                    "class"=>"input",
                    "required"=>true,
                    "min"=>3,
                    "max"=>30,
                    "value"=>$this->getTitle(),
                    "error"=>""
                ]
            ]

        ];
    }
}