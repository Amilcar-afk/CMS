<?php
namespace App\Controller;

use App\Core\Query;


class Middleware{

    public static function auth(){
        if(!empty($_SESSION['Auth']->token) && !empty($_SESSION['Auth']->id)){

            $user = Query::from('cmspf_Users')
                ->where("id = '" . $_SESSION['Auth']->id . "'")
                ->where("confirm = '1'")
                ->where("deleted IS NULL")
                ->execute("User")[0];

            if ($user->getId() == null){
                header('location:/login');
            }

            if($user->getToken() != $_SESSION['Auth']->token){
                header('location:/login');
            }

            $_SESSION['Auth']->rank = $user->getRank();
        }

        if(!isset($_SESSION['Auth']->rank)){
            if($_SERVER['REQUEST_URI'] !== '/logout' && $_SERVER['REQUEST_URI'] !== '/login' ){
                $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
                header('location:/login');
            }
        }
    }

    public static function admin(){
        if(isset($_SESSION['Auth']) && $_SESSION['Auth']->rank != 'admin'){
            header('location:/login');
        }
    }

}