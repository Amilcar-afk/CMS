<?php
namespace App\Controller;

session_start();


class Authadmin{

    public static function isLogged(){
        if(!isset($_SESSION['Auth'])){
            header('location:/login');
            exit;
        }
    }






    

    public static function logout(){
        unset($_SESSION['Auth']);
        header('location:/login');
    }

    public static function accessUser(){
        if($_SESSION['Auth']->rank != 1){
            header('location:/login');
            exit; 
        }
    }
    
}