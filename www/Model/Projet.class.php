<?php


namespace App\Model;

use App\Core\BaseSQL;


class Projet extends BaseSQL
{
    protected $id = null;
    protected $user_key = null;
    protected $page_key = null;
    protected $title;
    protected $description;

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
     * @return mixed
     */
    public function getDescription(): ? string
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

    public function user()
    {
        $users = parent::belongsToMany(User::class, 'cmspf_User_projet');
        foreach ($users as $user){
            if($user->getId() != $_SESSION['auth']->id){
                return $user;
            }
        }
    }

    public function getFormCreateProject($users): array
    {

        foreach($users as $user){
            $usersList['choices'][] = [
                "value" => $user->getId(),
                "label" => $user->getLastname() . ' ' . $user->getFirstname(),
                "class"=>"input"
            ];
        }
        
        return [
            "config"=>[
                "method"=>"POST",
                "submit"=>"Save",
                "id"=>"formNewProject",
                "idButton"=>"buttonSaveProject",
                "cta"=>"cta-button-compose-project"
            ],

            "inputs"=>[

                "id"=>[
                    "type"=>"hidden",
                    "name"=>"id",
                    "class"=>"input",
                    "value"=>$this->getId(),
                    "error"=>""
                ],

                "title"=>[
                    "question"=>"Title",
                    "type"=>"text",
                    "placeholder"=>"Title",
                    "name"=>"title",
                    "class"=>"input",
                    "required"=>true,
                    "min"=>3,
                    "max"=>30,
                    "value"=>$this->getTitle(),
                    "error"=>""
                ],

                "user"=>[
                    "question"=>"Assign user",
                    "type"=>"select",
                    "name"=>"user",
                    "id"=>"selectUsers",
                    "value"=>$this->user(),
                    "class"=>"input",
                    "error"=>"",
                    "idToVerif"=>true,
                    "div"=>"divUserSearch",
                    "choices"=>$usersList['choices']
                ],
            ],
        ];
    }
}