<?php

namespace App;

require "conf.inc.php";
require 'vendor/autoload.php';

function myAutoloader($class){

    $class = str_ireplace("App\\", "", $class);
    $class = str_ireplace("\\", "/", $class);
    if(file_exists($class.".class.php")){
        include $class.".class.php";
    }
}

spl_autoload_register("App\myAutoloader");

$uri = $_SERVER["REQUEST_URI"]; 
$routeFile = "routes.yml";

if(!file_exists($routeFile)){
    die("Le fichier ".$routeFile." n'existe pas");
}

$routes = yaml_parse_file($routeFile);

if( empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"])  ){

    $parseUrl = explode("/", parse_url($uri, PHP_URL_PATH));
    for($i=0;$i<=sizeof($parseUrl);$i++){
        array_pop($parseUrl);
        $uri = implode('/',$parseUrl);
        if(isset($routes[$uri]) ){
            break;
        }else{
            die("Page 404");
        }
    }

    $url = $_SERVER["REQUEST_URI"]; 
    $replace = str_replace($uri,'',$url);
    $param = explode('/',$replace);
    array_shift($param);

    if(!isset($routes[$uri]['params']))
    {
        die("invalid params");

    }

    if( sizeof($param) != sizeof($routes[$uri]['params']))
    {
        die("invalid params");
    }



    // array_shift($parseUrl);
    // $uri = '/'.$parseUrl[0];
    // if(count($parseUrl) > 1 && isset($routes[$uri]['params']) ){
    //     echo '';
    // }else{
    //     $uri = $uri.'/'.$parseUrl[1];
    //     if(count($parseUrl) > 1 && isset($routes[$uri]['params']) ){
    //         echo '';
    //     }else{
    //         die("Page 404");
    //     }
    // }
}

$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);

$controllerFile = "Controller/".$controller.".class.php";
if(!file_exists($controllerFile)){
    die("Le controller ".$controllerFile." n'existe pas");
}
include $controllerFile; 

$controller = "App\\Controller\\".$controller; 
if( !class_exists($controller) ){
   die("La classe ".$controller." n'existe pas");
}

$objectController = new $controller(); 

if( !method_exists($objectController, $action) ){
    die("La methode ".$action." n'existe pas");
}
$objectController->$action();



