<?php
namespace App\Controller;

use App\Core\Query;

session_start();


class Middleware{

    public static function auth(){
        if(!empty($_SESSION['Auth']->token) && !empty($_SESSION['Auth']->id)){

            $tokenVerif = Query::from('cmspf_Users')
                ->where("token = '" . $_SESSION['Auth']->token . "'")
                ->where("confirm = '1'")
                ->execute("User");

            if (!count($tokenVerif) > 0){
                header('location:/login');
            }
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