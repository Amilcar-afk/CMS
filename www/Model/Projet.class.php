<?php


namespace App\Model;

use App\Core\BaseSQL;
use App\Core\Query;
use App\Model\Step;


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
        $users = parent::belongsToMany(User::class, 'cmspf_User_projet', "id", "id", null, null, 'NOT');
        foreach ($users as $key => $user){
            if($user->getDeleted() === "1"){
                unset($users[$key]);
            }
        }
        return $users;
        return users;
    }

    public function usersInproject()
    {
        $users =  parent::belongsToMany(User::class, 'cmspf_User_projet');
        foreach ($users as $key => $user){
            if($user->getId() == $_SESSION['Auth']->id){
                unset($users[$key]);
            }
        }
        return $users;
    }

    public function checkUserExist($usersFind, $usersId)
    {
        foreach ($usersId as $id){
            if($usersFind->find($id) === false){
                return false;
            }
        }
        return true;
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

    public function getSteps()
    {
        return array_reverse(parent::hasMany(Step::class, 'projet_key'));
    }

    public function getFormProject($users,$usersOfProject = null, $name = ''): array
    {

        foreach($users as $user){
            $usersList['choices'][] = [
                "value" => $user->getId(),
                "label" => $user->getLastname() . ' ' . $user->getFirstname(),
                "class"=>"input"
            ];
        }

        if($usersOfProject !== null){
            foreach($usersOfProject as $user) {
                $usersProjectList['choices'][] = [
                    "value" => $user->getId(),
                    "label" => $user->getLastname() . ' ' . $user->getFirstname(),
                    "class" => "input"
                ];
            }
        }else{
            $usersProjectList = null;
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
                    "choices"=>$usersList['choices'],
                    "searchBox"=>true,
                    "usersInProject"=>isset($usersProjectList['choices']) ? $usersProjectList['choices'] : null
                ],

                "description"=>[
                    "question"=>"Project description",
                    "placeholder"=>"description",
                    "type"=>"textarea",
                    "name"=>"description",
                    "value"=>$this->getDescription(),
                    "class"=>"input",
                    "rows"=>16,
                    "cols"=>"",
                    "error"=>""
                ],
            ],
        ];
    }
}