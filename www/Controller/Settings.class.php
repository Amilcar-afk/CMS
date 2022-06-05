<?php

namespace App\Controller;

use App\Core\View;

class Settings
{
    public function listStyle()
    {
        $view = new View("style", "back");
    }
}