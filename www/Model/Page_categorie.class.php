<?php
namespace App\Model;

use App\Core\BaseSQL;

class Page_categorie extends BaseSQL
{
    public $id = null;
    protected $table_name = 'cmspf_Page_categorie';
    protected $page_key;
    protected $categorie_key;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getPageKey()
    {
        return $this->page_key;
    }

    /**
     * @param mixed $page_key
     */
    public function setPageKey($page_key): void
    {
        $this->page_key = $page_key;
    }

    /**
     * @return mixed
     */
    public function getCategorieKey()
    {
        return $this->categorie_key;
    }

    /**
     * @param mixed $categorie_key
     */
    public function setCategorieKey($categorie_key): void
    {
        $this->categorie_key = $categorie_key;
    }

    /**
     * @return null
     */
    public function getId(): ? int
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


    public function save()
    {
        parent::save();
    }

    public function delete($id)
    {
        return parent::delete($id);

    }
}

   