<?php

namespace App\Model;


class Page
{
    protected $id = null;
    protected $dateUpdate;
    protected $description;
    protected $title;
    protected $status;

    /**
     * Page constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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

    public function getPage(): array
    {
        return [
            "meta"=>[
                "id"=>"",
                "title"=>"",
                "dateUpdate"=>"",
                "status"=>""
            ],
            "sections"=>[
                [
                    "id"=>"",
                    "witdth"=>"",
                    "background"=>"",
                    "siteElements"=>[
                        [
                            "id"=>"",
                            "type"=>"",
                            "font"=>"",
                            "color"=>"",
                            "background"=>"",
                            "fontSize"=>"",
                            "hAlign"=>""
                        ],
                    ],
                ],
            ],
        ];
    }
}