<?php

namespace App\Model;

use App\Core\BaseSQL;

class Page extends BaseSQL
{
    public $id = null;
    protected $dateUpdate;
    protected $description;
    protected $title;
    protected $status;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function save()
    {
        parent::save();
    }

    public function find($id = null, $attribut = 'id')
    {
        parent::find($id, $attribut);
    }

    /**
     * @return null
     */
    public function getId()
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

    public function getPageData(): array
    {
        return [
            "meta"=>[
                "id"=>"",
                "date_update"=>"",
                "user_key"=>"",
                "status"=>"",
                "title"=>"",
                "description"=>""
            ],
            "sections"=>[
                [
                    "id"=>"",
                    "bessels"=>"",
                    "background"=>"",
                    "place"=>"",
                    "components"=>[
                        [
                            "id"=>"",
                            "type"=>"",
                            "place"=>"",
                            "witdth"=>"",
                            "highlight"=>"",
                            "font"=>"",
                            "font_size"=>"",
                            "font_weight"=>"",
                            "color"=>"",
                            "background"=>"",
                            "align"=>"",
                            "contents"=>[
                                [
                                    "content"=>"",
                                    "date"=>"",
                                    "other"=>""
                                ]
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }
}