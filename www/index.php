<?php
namespace App;

require "conf.inc.php";


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

// fichier routes.yml en forme de tableau d'objet {  ["/"]=> array(2) ["controller"]=> string(7) "general" ["action"]=> string(4) "home" }
$routes = yaml_parse_file($routeFile);



if( empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"]) ){
        die("Page 404");
}

//mettre la prmiere lettre du controlleur en majuscule
$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]); // la methode du controlleur

// $controller = User ou $controller = Global
// $action = login ou $action = logout ou $action = home

$controllerFile = "Controller/".$controller.".class.php";
if(!file_exists($controllerFile)){
    die("Le controller ".$controllerFile." n'existe pas");
}
include $controllerFile; // inclut le fichier du controller courrant

$controller = "App\\Controller\\".$controller; //App\Controller\le nom de la class

if( !class_exists($controller) ){
   die("La classe ".$controller." n'existe pas");
}

$objectController = new $controller(); //instancier l'objet e la classe courante

if( !method_exists($objectController, $action) ){
    die("La methode ".$action." n'existe pas");
}

$objectController->$action();//on apelle l'action "methode" defini dans le fichier route.yml grance a l'instance de la classe courante




