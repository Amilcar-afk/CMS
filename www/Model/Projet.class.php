<?php


namespace App\Model;

use App\Core\BaseSQL;
use App\Core\Query;


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

    public function usersNotInProject()
    {
        return parent::belongsToMany(User::class, 'cmspf_User_projet', "id", "id", null, null, 'NOT');
    }

    public function usersInproject()
    {
        return parent::belongsToMany(User::class, 'cmspf_User_projet');
    }

    public function isAdmin()
    {
        $req = Query::from('cmspf_User_project')
            ->where('projet_key = ' . $this->getId())
            ->where('user_key = ' . $_SESSION['Auth']->id)
            ->where('type = "owner"')
            ->execute('User_projet');

        if(!empty($req[0]))
            return true;
        return false;
    }

    public function getFormProject($users, $name = ''): array
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
                "idButton"=>"buttonSaveProject".$name,
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
                    "placeholder"=>"Title",
                    "type"=>"select",
                    "name"=>"user",
                    "id"=>"selectUsers".$name,
                    "value"=>$this->usersInproject(),
                    "class"=>"input inputSelect",
                    "error"=>"",
                    "idToVerif"=>true,
                    "div"=>"divUserSearch",
                    "choices"=>$usersList['choices']
                ],

                "description"=>[
                    "question"=>"Project description",
                    "placeholder"=>"description",
                    "type"=>"textarea",
                    "name"=>"description",
                    "class"=>"input",
                    "rows"=>16,
                    "cols"=>"",
                    "error"=>""
                ],
            ],
        ];
    }
}