<?php
namespace App\Controller;

session_start();


class Middleware{

    public static function auth(){
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