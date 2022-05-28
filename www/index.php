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

if( empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"])  ){

    $parseUrl = explode("/", parse_url($uri, PHP_URL_PATH));
    for($i=0;$i<=sizeof($parseUrl);$i++){
        array_pop($parseUrl);
        $uri = implode('/',$parseUrl);
        if(isset($routes[$uri]) ){
            $url = $_SERVER["REQUEST_URI"]; 
            $replace = str_replace($uri,'',$url);
            $param = explode('/',$replace);
            array_shift($param);
            if( sizeof($param) != sizeof($routes[$uri]['params']))
            {
                die("invalid params");
            }
            if(!isset($routes[$uri]['params']))
            {
                die("invalid params");
            }
            break;
        }else{
            die("Page 404");
        }
    }
}

if(isset($routes[$uri]["middleware"]) ){
    $authFile = 'Controller/middleware.class.php';
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




// ucfirst(strtolower( mettre la prmiere lettre du controlleur en majuscule
$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]); // la methode du controlleur

// $controller = User ou $controller = Global
// $action = login ou $action = logout ou $action = home

//$controllerFile contient le controller courant
$controllerFile = "Controller/".$controller.".class.php";
//verifie l'existance du controller 
if(!file_exists($controllerFile)){
    die("Le controller ".$controllerFile." n'existe pas");
}
include $controllerFile; // inclut le fichier du controller courrant

//la variable $controller contient la class du controller couant
$controller = "App\\Controller\\".$controller; //App\Controller\le nom de la class

//verifie l'existance du class du controller et renvoie un message d'erruer si celuici existe pas 

if( !class_exists($controller) ){
   die("La classe ".$controller." n'existe pas");
}

$objectController = new $controller(); //instancier l'objet e la classe courante

//method_exists verifie l'existance de la methode de l'objet l'objet   et renvoie un message d'erruer si celuici existe pas 

if( !method_exists($objectController, $action) ){
    die("La methode ".$action." n'existe pas");
}

$objectController->$action();//on apelle l'action "methode" defini dans le fichier route.yml grance a l'instance de la classe courante
