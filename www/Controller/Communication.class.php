<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User;
use App\Model\Project;

class Communication
{
    public $conversation;
    protected $project;

    public function __construct()
    {
        $this->project = new Project();
    }

    public function listConversation()
    {
        $view = new View("conversation-list", "back");
    }

    public function listProject()
    {
        $view = new View("project-list", "back");
        $view->assign("user", $this->project);
    }
}