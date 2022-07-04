<?php

namespace App\Controller;

use App\Core\Query;
use App\Core\View;
use App\Model\User;
use App\Model\Projet;
use App\Model\User_projet;
use App\Core\Validator;

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
        $view = new View("project-list", "back");

        $user = new User();
        $user = $user->find($_SESSION['Auth']->id);
        $view->assign("projects", $user->projects());

        $view->assign("usersProject", $user->find());

        $projectEmpty = $this->project;
        $view->assign("projectEmpty", $projectEmpty);
    }

    public function composeProject()
    {

        //$admin = $this->project->isAdmin();
        $admin = $_SESSION['Auth']->rank;

        if(!empty($_POST) && $admin === "admin"){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $projectId = $_POST['id'];

            $result = Validator::run($this->project->getFormProject(), $_POST,false);

            if(!empty($result)) {

                if (isset($title) && !empty($title))
                    $this->project->setTitle($title);

                if (isset($description) && !empty($description))
                    $this->project->setDescription($description);

                if (isset($projectId) && !empty($projectId))
                    $this->project->setId($projectId);

            }else{
                http_response_code(400);
            }

        }else{
            http_response_code(400);
        }

            //$view = new View("project-list", "back");
            //$result = Validator::run($this->project->getFormCreateProject(), $_POST,false);

            //if(empty($result)){

            /*$this->project->setTitle($_POST['title']);
            $this->project->setDescription($_POST['description']);
            $this->project->setUserKey($_SESSION['Auth']->id);
            $this->project->save();

            $idProject = $this->project->getLastId();
            $users = new User();
            $users = $users->find();

            if(!empty($idProject)) {
                $projectUserKeys = explode(",", $_POST['users']);

                foreach ($projectUserKeys as $key => $userKey) {
                    $this->user_project->setUserKey($userKey);
                    $this->user_project->setProjectKey($idProject);
                    $this->user_project->save();
                }

                $projectEmpty = $this->project;
                $projects = $this->project->find();

                $view->assign("projects",$projects);
                $view->assign("users", $users);
                $view->assign("projectEmpty", $projectEmpty);

            }else{
                http_response_code(400);
            }

            /*}else{
                $view->assign("error_from",$result);
            }*/

        /*}else{
            http_response_code(400);
        }*/
    }
}