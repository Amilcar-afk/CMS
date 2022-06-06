<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User;

class Communication
{
    public $convresation;

    public function __construct()
    {
    }

    public function listConversation()
    {
        $view = new View("conversation-list", "back");
    }
}