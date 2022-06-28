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
        $userProject = Query::from('cmspf_Projets')->where('user_key = ' . $_SESSION['Auth']->id)->execute();
        $usersProject = [];

        if(count($userProject) > 0){

            foreach ($userProject as $key => $project) {
                $idProject = $userProject[$key]['id'];
                $this->project->setId($idProject);
                $usersProject[$key] = $this->project->user();
            }

        }

        $view = new View("project-list", "back");

        $projects = $this->project->find();
        $view->assign("projects",$projects);

        $users = new User();
        $users = $users->find();
        $view->assign("users", $users);

        $view->assign("usersProject", $usersProject);

        $projectEmpty = $this->project;
        $view->assign("projectEmpty", $projectEmpty);
    }

    public function composeProject()
    {
        if(!empty($_POST)){

            $view = new View("project-list", "back");
            //$result = Validator::run($this->project->getFormCreateProject(), $_POST,false);

            //if(empty($result)){

            $this->project->setTitle($_POST['title']);
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

        }else{
            http_response_code(400);
        }
    }
}