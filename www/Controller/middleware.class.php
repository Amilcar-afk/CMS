<?php
namespace App\Controller;

session_start();


class Middleware{

    public static function auth(){
        if(!isset($_SESSION['Auth'])){
            header('location:/login');
            exit;
        }
    }


    public static function admin(){
        if($_SESSION['Auth']->rank != 1){
            header('location:/login');
            exit; 
        }
    }
    
}