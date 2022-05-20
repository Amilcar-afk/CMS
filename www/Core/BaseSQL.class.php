<?php

namespace App\Core;


abstract class BaseSQL
{
    private $pdo;
    private $table;
    private $lastInsertId;

    /**
     * get_called_class()  Retourne le nom de la classe depuis laquelle une méthode statique a été appelée.
     * strtolower() convertir le maj to mini 
     * get_object_vars(this) Retourne les propriétés d'un objet
     * get_class_vars(class) Retourne les valeurs par défaut des propriétés d'une classe
     * get_class() Retourne le nom de la classe d'un objet
     * array_filter(columns) Filtre les éléments d'un tableau grâce à une fonction de rappel
     * array_diff_key($columns, $varsToExclude) Calcule la différence de deux tableaux en utilisant les clés pour comparaison
     */


    public function __construct()
    {
        //remplacer par singleton
        try{
            $this->pdo = new \PDO( DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME ,DBUSER ,DBPWD );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\Exception $e){
            die("Erreur SQL".$e->getMessage());
        }
        // $classExploded = explode("\\",get_called_class());
        // $this->table = DBPREFIXE.(end($classExploded)).'s';

        if(isset($this->table_name)){
            $this->table = DBPREFIXE.$this->table_name;
        }else{
            $classExploded = explode("\\",get_called_class());
            $this->table = DBPREFIXE.(end($classExploded)).'s';
        }
        

    }

    /**
     * @param mixed $id
     */
    public function setId($id): object
    {
        $sql = "SELECT * FROM ".$this->table. " WHERE id=:id ";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( ["id"=>$id] );
        return $queryPrepared->fetchObject(get_called_class());
    }

    protected function save()
    {

        $columns  = get_object_vars($this);

        // $varsToExclude = get_class_vars(get_class());
        // $columns = array_diff_key($columns, $varsToExclude);
        // $columns = array_filter($columns);

        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
            foreach($columns as $column => $value ){
                $table_name = 'table_name';
                if(isset($table_name )){
                    unset($columns[$table_name]);
                     continue;
                }else{
                    echo 'introuvable';
                }
            }
        $columns = array_filter($columns);

        if( !is_null($this->getId()) ){
            foreach ($columns as $key=>$value){
                    $setUpdate[]=$key."=:".$key;
            }
            $sql = "UPDATE ".$this->table." SET ".implode(",",$setUpdate).
            " WHERE id=".$this->getId();

        }else{
            $sql = "INSERT INTO ".$this->table." (".implode(",", array_keys($columns)).")
            VALUES (:".implode(",:", array_keys($columns)).")";

        }
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($columns);
        $lastInsertd = $this->pdo->lastInsertId();
        $this->setLastId($lastInsertd );
    }


    protected function test()
    {
        $columns  = get_object_vars($this);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
            foreach($columns as $column => $value ){
                // var_dump($column);

                if($column === 'table_name'){
                    continue;
                }else{
                    var_dump($column);
                }
            }

        $columns = array_filter($columns);
    }





    public function setLastId($lastId)
    {
        $this->lastInsertId = $lastId;

    }

    public function getLastId()
    {
        return $this->lastInsertId;
    }

    
    public function parseUrl()
    {
        $routeFile = "routes.yml";
        $routes = yaml_parse_file($routeFile);
        return $routes;
    }


 
    public function getPramsFromUri()
    {
        
        $url = $_SERVER['REQUEST_URI'];
        $routeFile = "routes.yml";
        $routes = yaml_parse_file($routeFile);
        $parseUrl = explode('/', parse_url($url, PHP_URL_PATH));
        array_shift($parseUrl);

        $paramsNumber = count($parseUrl);
        $allParams =[];
        $paramsOfUri=[];
        $uri = '/'.$parseUrl[0];

        if(!isset($routes[$uri]['params']) ){
            $uri = $uri.'/'.$parseUrl[1];
            $paramsNumber = $paramsNumber - 1;
        }
        
        for($i=1;$i<=($paramsNumber - 1);$i++){
            array_push($paramsOfUri,$parseUrl[$i]);
        }

        if(count($routes[$uri]['params']) != count($paramsOfUri)){
            echo 'nombre de parametre invallid <br>';
            die();
        }

        foreach($routes[$uri]['params'] as $param => $value){
            $allParams[$value] = $paramsOfUri[$param];
        }

        return $allParams;

    }


    function findOneData( string $sql, $params) {

        $statement = $this->pdo->prepare($sql);
        if($statement) {
            $success = $statement->execute($params)or die(print_r($statement->errorInfo(), TRUE));
            if($success) {
                $res = $statement->fetch(\PDO::FETCH_OBJ);
                if($res) {
                    return $res;
                }
            }
        }
        return null;
    }


    function findAllData(string $sql, array $params= null) {
        $statement = $this->pdo->prepare($sql);
        if($statement) {
            $success = $statement->execute($params) or die(print_r($statement->errorInfo(), TRUE));
            if($success) {
                $res = $statement->fetchAll(\PDO::FETCH_OBJ);
                if($res) {
                    return $res;
                }
            }
        }
        return null;
    }


    public function insertData( string $sql, array $params): ?string {

        $statement = $this->pdo->prepare($sql);
        if($statement) {
            $success = $statement->execute($params)or die(print_r($statement->errorInfo(), TRUE));
            if($success) {
                return $this->pdo->lastInsertId();
            }
        }
        return null;
    }

    public function delete( string $sql, array $params): ?string {

        $statement = $this->pdo->prepare($sql);
        if($statement) {
            $success = $statement->execute($params)or die(print_r($statement->errorInfo(), TRUE));
        }
        return null;
    }




}