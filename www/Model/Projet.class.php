<?php


namespace App\Model;

use App\Core\BaseSQL;


class Projet extends BaseSQL
{
    protected $id = null;
    protected $user_key = null;
    protected $page_key = null;
    protected $title;

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
     * Get the value of id
     */
    public function getId(): ? int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUserKey(): ? int
    {
        return $this->user_key;
    }

    public function setUserKey($id)
    {
        $this->user_key = $id;
        return $this;
    }

    public function getPageKey(): ? int
    {
        return $this->page_key;
    }

    public function setPageKey($id)
    {
        $this->page_key = $id;
        return $this;
    }

    public function save()
    {
        parent::save();
    }

    public function delete($id)
    {
        return parent::delete($id);

    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

    public function getFormCreateProject($users): array
    {

        foreach($users as $user){
            $usersList['choices'][] = [
                "value" => $user->getId(),
                "label" => $user->getLastname() . $user->getFirstname(),
                "class"=>"input"
            ];
        }
        
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Create project",
                "class"=>"form-in-popup"
            ],
            "inputs"=>[

                "title"=>[
                    "question"=>"title",
                    "type"=>"text",
                    "placeholder"=>"Title*",
                    "value"=> $this->getTitle(),
                    "name"=>"titleRegister",
                    "class"=>"input",
                    "min"=>2,
                    "max"=>50,
                    "error"=>""
                ],
                "user"=>[
                    "question"=>"Assign user",
                    "type"=>"select",
                    "name"=>"user",
                    "class"=>"input",
                    "error"=>"",
                    "idToVerif"=>true,
                    "choices"=>$usersList['choices']
                ],
            ],
        ];
    }
}