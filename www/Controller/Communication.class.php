<?php

namespace App\Controller;

use App\Core\Query;
use App\Core\View;
use App\Model\User;
use App\Model\Projet;
use App\Model\User_projet;

class Communication
{
    public $conversation;
    protected $project;
    protected $user_project;

    public function __construct()
    {
        $this->project = new Projet();
        $this->user_project = new User_projet();
    }

    public function listConversation()
    {
        $view = new View("conversation-list", "back");
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
        print_r($_POST);

        /*$projectEmpty = $this->project;
        $projects = $this->project->find();
        $users = new User();
        $users = $users->find();*/

        if(!empty($_POST)){
            //$view = new View("project-list", "back");
            $this->project->setTitle($_POST['title']);
            $this->project->setDescription($_POST['description']);
            $this->project->setUserKey($_SESSION['Auth']->id);
            $this->project->save();

            $idProject = $this->project->getLastId();

            $projectUserKeys = explode(",", $_POST['users']);

            foreach ($projectUserKeys as $userKey){
                $this->user_project->setUserKey($userKey);
                $this->user_project->setProjectKey($idProject);
                $this->user_project->save();
            }

        }
    }
}