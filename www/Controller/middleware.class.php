<?php
namespace App\Controller;

session_start();


class Middleware{

    public static function auth(){
        if(!isset($_SESSION['Auth']->rank)){
            header('location:/login');
        }
    }

    public static function admin(){
        if($_SESSION['Auth']->rank != 'admin'){
            header('location:/login');
        }
    }

}