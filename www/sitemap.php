<?php

$routeFile = "routes.yml";

if(!file_exists($routeFile)){
    die("Le fichier ".$routeFile." n'existe pas");
}

$routes = yaml_parse_file($routeFile);





header('Content-Type: text/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";


?>
