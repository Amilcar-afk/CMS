<?php


namespace App\Model;


class Component
{
    public $id = null;
    protected $place;
    protected $type;
    protected $width;
    protected $font;
    protected $color;
    protected $background;
    protected $font_size;
    protected $font_weight;
    protected $highLight;
    protected $align;
    protected $section_key;

    /**
     * @return mixed
     */
    public function getFontWeight()
    {
        return $this->font_weight;
    }

    /**
     * @param mixed $font_weight
     */
    public function setFontWeight($font_weight): void
    {
        $this->font_weight = $font_weight;
    }

    /**
     * @return mixed
     */
    public function getHighLight()
    {
        return $this->highLight;
    }

    /**
     * @param mixed $highLight
     */
    public function setHighLight($highLight): void
    {
        $this->highLight = $highLight;
    }

    /**
     * @return mixed
     */
    public function getSectionKey()
    {
        return $this->section_key;
    }

    /**
     * @param mixed $section_key
     */
    public function setSectionKey($section_key): void
    {
        $this->section_key = $section_key;
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
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place): void
    {
        $this->place = $place;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * @param mixed $font
     */
    public function setFont($font): void
    {
        $this->font = $font;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
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

    /**
     * @return mixed
     */
    public function getFontSize()
    {
        return $this->font_size;
    }

    /**
     * @param mixed $font_size
     */
    public function setFontSize($font_size): void
    {
        $this->font_size = $font_size;
    }

    /**
     * @return mixed
     */
    public function getAlign()
    {
        return $this->align;
    }

    /**
     * @param mixed $align
     */
    public function setAlign($align): void
    {
        $this->align = $align;
    }

    public function save()
    {
        parent::save();
    }

}