<?php


namespace App\Model;


class Section
{
    protected $id;
    protected $witdth;
    protected $background;

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
    public function getWitdth()
    {
        return $this->witdth;
    }

    /**
     * @param mixed $witdth
     */
    public function setWitdth($witdth): void
    {
        $this->witdth = $witdth;
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