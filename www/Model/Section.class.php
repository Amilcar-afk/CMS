<?php


namespace App\Model;


class Section
{
    protected $id;
    protected $background;
    protected $bessels;

    /**
     * @return mixed
     */
    public function getBessels()
    {
        return $this->bessels;
    }

    /**
     * @param mixed $bessels
     */
    public function setBessels($bessels): void
    {
        $this->bessels = $bessels;
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * @param mixed $background
     */
    public function setBackground($background): void
    {
        $this->background = $background;
    }
}