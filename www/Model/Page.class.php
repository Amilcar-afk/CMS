<?php

namespace App\Model;

use App\Controller\Statistics;
use App\Core\BaseSQL;
use Categorie;

class Page extends BaseSQL
{
    public $id = null;
    protected $dateUpdate;
    protected $description;
    protected $title;
    protected $status;
    protected $slug;
    protected $user_key;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function composeStats(int $elementId, string $type)
    {
        $stat = new Statistics();
        $stat->composeStats($elementId, $type);
    }

    public function save()
    {
        parent::save();
    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

    public function categories()
    {
        return parent::belongsToMany(Categorie::class, 'cmspf_Page_categorie');
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
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
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
        return $this->dateUpdate;
    }

    /**
     * @param mixed $dateUpdate
     */
    public function setDateUpdate($dateUpdate): void
    {
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTitle()
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
    public function getStatus()
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

    public function getFormNewPage(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"page/compose",
                "submit"=>"Save"
            ],
            "inputs"=>[
                "title"=>[
                    "question"=>"Title",
                    "type"=>"text",
                    "placeholder"=>"Page title",
                    "name"=>"title",
                    "class"=>"input",
                    "required"=>true,
                ],
                "status"=>[
                    "question"=>"Visibility",
                    "type"=>"select",
                    "name"=>"status",
                    "class"=>"input",
                    "required"=>true,
                    "choices"=>[
                        [
                            "value" => "Public",
                            "label" => "Public",
                            "class"=>"input"
                        ],
                        [
                            "value" => "Draft",
                            "label" => "Draft",
                            "class"=>"input"
                        ],
                    ]
                ],
                "slug"=>[
                    "question"=>"Slug",
                    "type"=>"text",
                    "name"=>"slug",
                    "placeholder"=>"Page slug",
                    "class"=>"input",
                    "required"=>true,
                ],
                "description"=>[
                    "question"=>"Description",
                    "type"=>"textarea",
                    "placeholder"=>"Page description",
                    "name"=>"description",
                    "class"=>"input",
                    "required"=>true,
                ]
            ]

        ];
    }
}