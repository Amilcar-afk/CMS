<?php

namespace App\Controller;

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
        var_dump($_POST);
    }
}