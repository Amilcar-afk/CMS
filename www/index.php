<?php

namespace App;

require "conf.inc.php";
require 'vendor/autoload.php';


function myAutoloader($class){

    //$class = App\Core\CleanWords
    $class = str_ireplace("App\\", "", $class);
    //$class = Core\CleanWords
    $class = str_ireplace("\\", "/", $class);
    //$class = Core/CleanWords
    if(file_exists($class.".class.php")){
        include $class.".class.php";
    }
}

spl_autoload_register("App\myAutoloader");


$uri = $_SERVER["REQUEST_URI"]; // => " / "

$routeFile = "routes.yml";

if(!file_exists($routeFile)){
    die("Le fichier ".$routeFile." n'existe pas");
}

$routes = yaml_parse_file($routeFile);


if( empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"])  ){

    $parseUrl = explode("/", parse_url($uri, PHP_URL_PATH));
    $uri = '/'.$parseUrl[1];
    if(count($parseUrl) > 2 && isset($routes[$uri]['params']) ){
        echo '';
    }else{
        die("Page 404");
    }

    // $pattern = '/([^\/$])([0-9])/';
    // $replacement = 'id';
    // $uri =  preg_replace($pattern, $replacement, $uri);
    // if(empty($routes[$uri])){
    //     die("Page 404");
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



