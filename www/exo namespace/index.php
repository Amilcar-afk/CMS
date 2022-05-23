<?php

namespace App;

use App\Page\Security;
use App\User\Security as Secu;

require "securityPage.class.php";
require "securityUser.class.php";


new Security();
new Secu();