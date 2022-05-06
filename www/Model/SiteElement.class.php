<?php


namespace App\Model;


class SiteElement
{
    protected $id = null;
    protected $type;
    protected $width;
    protected $font;
    protected $color;
    protected $background;
    protected $fontSize;
    protected $hAlign;

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
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * @param mixed $typ
     */
    public function setTyp($typ): void
    {
        $this->typ = $typ;
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
        return $this->fontSize;
    }

    /**
     * @param mixed $fontSize
     */
    public function setFontSize($fontSize): void
    {
        $this->fontSize = $fontSize;
    }

    /**
     * @return mixed
     */
    public function getHAlign()
    {
        return $this->hAlign;
    }

    /**
     * @param mixed $hAlign
     */
    public function setHAlign($hAlign): void
    {
        $this->hAlign = $hAlign;
    }


}