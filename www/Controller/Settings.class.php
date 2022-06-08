<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User;
use App\Model\Option;

class Settings
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function listStyle()
    {
        $view = new View("style", "back");
    }

    public function listUser()
    {
        $users = $this->user->find();
        $view = new View("user-manager", "back");
        $view->assign("users", $users);
    }

    public function composeDatabase()
    {
        $view = new View("database", "back");
    }

    public function listMedia()
    {
        $view = new View("media-library", "back");
    }
}