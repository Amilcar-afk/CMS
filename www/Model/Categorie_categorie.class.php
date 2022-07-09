<?php
namespace App\Model;

use App\Core\BaseSQL;

class Categorie_categorie extends BaseSQL
{
    protected $id = null;
    protected $table_name = 'cmspf_Categorie_categorie';
    protected $categorie_parent_key;
    protected $categorie_child_key;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->table_name;
    }

    /**
     * @return mixed
     */
    public function getCategorieParentKey()
    {
        return $this->categorie_parent_key;
    }

    /**
     * @param mixed $categorie_parent_key
     */
    public function setCategorieParentKey($categorie_parent_key): void
    {
        $this->categorie_parent_key = $categorie_parent_key;
    }

    /**
     * @return mixed
     */
    public function getCategorieChildKey()
    {
        return $this->categorie_child_key;
    }

    /**
     * @param mixed $categorie_child_key
     */
    public function setCategorieChildKey($categorie_child_key): void
    {
        $this->categorie_child_key = $categorie_child_key;
    }

    public function delete($id)
    {
        return parent::delete($id);
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


    public function save()
    {
        parent::save();
    }

}

   