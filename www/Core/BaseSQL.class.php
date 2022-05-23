<?php

namespace App\Core;


abstract class BaseSQL
{
    private $pdo;
    private $table;
    private $lastInsertId;






    

    public function __construct()
    {
        try{
            $this->pdo = new \PDO( DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME ,DBUSER ,DBPWD );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\Exception $e){
            die("Erreur SQL".$e->getMessage());
        }

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
        $url = $_SERVER["REQUEST_URI"]; 
        $routes = yaml_parse_file("routes.yml");
        $parseUrl = explode('/', parse_url($url, PHP_URL_PATH));
        for($i=0;$i<=sizeof($parseUrl);$i++){
            array_pop($parseUrl);
            $uri = implode('/',$parseUrl);
            if(isset($routes[$uri]) ){
                break;
            }
        }
        $e = str_replace($uri,'',$url);
        $param = explode('/',$e);
        array_shift($param);
        return $param;
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