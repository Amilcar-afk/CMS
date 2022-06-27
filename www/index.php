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

// en verifie l'existance du l'url l'existance du controller et l'existance de l'action
$currentParams = [];

if( empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"])  ){

    $parseUrl = explode("/", parse_url($uri, PHP_URL_PATH));
    for($i=0;$i<=sizeof($parseUrl);$i++){
        array_pop($parseUrl);
        $uri = implode('/',$parseUrl);
        if(!isset($routes[$uri]) ){
            $uri = "/pageloader";
        }

        $url = $_SERVER["REQUEST_URI"];
        $replace = str_replace($uri,'',$url);
        $param = explode('/',$replace);
        array_shift($param);

        if(sizeof($routes[$uri]['params']) === sizeof($param)){
            foreach($routes[$uri]['params'] as $key => $itemParam){
                $currentParams = [
                    $itemParam => $param[$key]
                ];
            }
        }


        if( sizeof($param) != sizeof($routes[$uri]['params']))
        {
            http_response_code(404);
        }
        if(!isset($routes[$uri]['params']))
        {
            http_response_code(404);
        }
        break;
    }
}

if(isset($routes[$uri]["middleware"]) ){
    $authFile = 'Controller/Middleware.class.php';
    include $authFile;

    $authController = "App\\Controller\\Middleware";
    if( !class_exists($authController) ){
        die("La classe ".$authController." n'existe pas");
    }
    $objectAuthController = new $authController();

    foreach($routes[$uri]["middleware"] as $action){
        $objectAuthController->$action();
    }
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

if(sizeof($currentParams)!=0){
    $objectController->$action($currentParams);
}else{
    $objectController->$action();
}
