<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User;

class Communication
{
    public $conversation;

    public function __construct()
    {
    }

    public function listConversation()
    {
        $view = new View("conversation-list", "back");
    }

    public function listProject()
    {
        $view = new View("project-list", "back");
    }
}