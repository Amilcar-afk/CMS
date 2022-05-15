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

    protected function save()
    {

        $columns  = get_object_vars($this);
        // $varsToExclude = get_class_vars(get_class());
        // $columns = array_diff_key($columns, $varsToExclude);
        // $columns = array_filter($columns);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
            foreach($columns as $column => $value ){
                if($column === 'table_name'){
                    continue;
                }
            }
        $columns = array_filter($columns);

       if( !is_null($this->getId()) ){
           foreach ($columns as $key=>$value){
                $setUpdate[]=$key."=:".$key;
           }
           $sql = "UPDATE ".$this->table." SET ".implode(",",$setUpdate)." WHERE id=".$this->getId();

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

        
        // foreach($columns as $column ){
        //     // var_dump($column);
        //     // if($column === 'table_name'){
        //     //     echo 12;
        //     //     continue;
        //     // }else{
        //     //     var_dump($column);
        //     // }
        // }
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
        $res = explode('/', parse_url($url, PHP_URL_PATH));
        $e = '/'.$res[1];
        $paramsNumber = count($res);
        $allParams =[];
        $paramsOfUri=[];

        for($i=2;$i<=($paramsNumber - 1);$i++){
            array_push($paramsOfUri,$res[$i]);
        }

        foreach($routes[$e]['params'] as $param => $value){
                $allParams[$value] = $paramsOfUri[$param];
        }
        return $allParams;

    }

/**
 * @param PDO $db
 * @param string $sql
 * @param array $params
 * @return array|null
 */

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


/**
 * @param PDO $db
 * @param string $sql
 * @param array $params
 * @return array|null
 */
    // function findAllData(string $sql, ?array $params): ?array  {

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



/**
 * @param PDO $db
 * @param string $sql
 * @param array $params
 * @return string|null
 */
    public function insertData( string $sql, array $params): ?string {

        $statement = $this->pdo->prepare($sql);
        if($statement) {
            $success = $statement->execute($params)or die(print_r($statement->errorInfo(), TRUE));
            if($success) {
                // createLog($sql, $params);
                return $this->pdo->lastInsertId();
            }
        }
        return null;
    }

/**
 * @param PDO $db
 * @param string $sql
 * @param array $params
 * @return string|null
 */
public function delete( string $sql, array $params): ?string {

    $statement = $this->pdo->prepare($sql);
    if($statement) {
        $success = $statement->execute($params)or die(print_r($statement->errorInfo(), TRUE));
    }
    return null;
}




/**
 * @param string $sql
 * @param array $params
 */
    // function createLog(string $sql, array $params){
    //     $actionLog = strtoupper(substr($sql, 0, strpos($sql, " ")));
    //     if ($actionLog != "SELECT") {

    //         switch ($actionLog) {
    //             case "DELETE":
    //                 $sql = substr($sql, strlen("DELETE FROM "));
    //                 $tableName = substr($sql, 0, strpos($sql, " "));
    //                 $action = "DELETED FROM ";
    //                 break;
    //             case "INSERT":
    //                 $sql = substr($sql, strlen("INSERT INTO "));
    //                 $tableName = substr($sql, 0, strpos($sql, " "));
    //                 $action = "INSERTED INTO ";
    //                 break;
    //             case "UPDATE":
    //                 $sql = substr($sql, strlen("UPDATE "));
    //                 $tableName = substr($sql, 0, strpos($sql, " "));
    //                 $action = "UPDATED ";
    //                 break;
    //             default:
    //                 $tableName = "database";
    //                 $action = "OPERATION IN ";
    //         }

    //         $keys = array_keys($params);
    //         $messageElements = "";
    //         $keyLog = 0;
    //         foreach ($params as $param) {
    //             $messageElements .= $keys[$keyLog] . " = " . $param . ((($keyLog == 0  count($keys) - 1 == $keyLog)  count($keys) == 1) ? " " : ", ");
    //             ++$keyLog;
    //         }

    //         $logUser = (isset($_SESSION["idUser"]) ? "USER#".$_SESSION["idUser"] : "ANONYM");

    //         error_log("[" . date('Y-m-d H:i:s (e)') . "][" . $_SERVER["REMOTE_ADDR"] . "][" . $actionLog . "] " . $logUser . " | ". $action . $tableName ." ". $messageElements . "\n", 3, '../logs/' . date('Y-m') . "-reports.log");

    //     }
    // }
}