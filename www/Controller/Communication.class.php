<?php

namespace App\Controller;

use App\Core\Query;
use App\Core\View;
use App\Model\User;
use App\Model\Projet;

class Communication
{
    public $conversation;
    protected $project;

    public function __construct()
    {
        $this->project = new Projet();
    }

    public function listConversation()
    {
        $view = new View("conversation-list", "back");
    }

    public function searchConversation()
    {

        $searchUsers = $_POST['searchData'];

        if (!empty($_POST)) {
            $users = Query::from('cmspf_Users')
                ->or("firstname LIKE '%" . $searchUsers . "%'")
                ->or("lastname LIKE '%" . $searchUsers . "%'")
                ->or("mail LIKE '%" . $searchUsers . "%'")
                ->execute("User");
            if(!empty($users)){
                foreach ($users as $user){
                    $conversations [] = array(
                        'id' => $user->getId(),
                        'email' => $user->getMail(),
                        'firstname' => $user->getFirstname(),
                        'lastname' => $user->getLastname(),
                    );
                }
                echo json_encode($conversations);
            }else{
                echo '';
            }
        }
    }

    public function listProject()
    {
        $projectEmpty = $this->project;
        $projects = $this->project->find();
        $users = new User();
        $users = $users->find();

        $view = new View("project-list", "back");
        $view->assign("projects",$projects);
        $view->assign("users", $users);
        $view->assign("projectEmpty", $projectEmpty);
    }

    public function composeProject()
    {

    }
}