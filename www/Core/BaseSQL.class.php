<?php

namespace App\Core;


abstract class BaseSQL
{
    private $pdo;
    private $table;
    private $lastInsertId;




    public function __construct()
    {
        //remplacer par singleton
        try{
            $this->pdo = new \PDO( DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME ,DBUSER ,DBPWD );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\Exception $e){
            die("Erreur SQL".$e->getMessage());
        }

        if(isset($this->table_name)){
            $this->table = $this->table_name;
        }else{
            $classExploded = explode("\\",get_called_class());
            $this->table = DBPREFIXE.(end($classExploded)).'s';
        }
    }

    // /**
    //  * @param mixed $id
    //  */
    // public function setId($id): object
    // {
    //     $sql = "SELECT * FROM ".$this->table. " WHERE id=:id ";
    //     $queryPrepared = $this->pdo->prepare($sql);
    //     $queryPrepared->execute( ["id"=>$id] );
    //     return $queryPrepared->fetchObject(get_called_class());
    // }

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
     * Delete element by id
     * @return void
     */
    protected function delete($id)
    {
        if( !is_null($this->getId()) ){

            $sql = "DELETE  FROM ".$this->table." WHERE id=".$this->getId();
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute();

        }else{
            http_response_code(400);
        }
    }

    /**
     * If you send id = return one ligne
     * If no id = all lignes
     * You can specify the name of the colunm "id"
     * @param mixed $id
     * @return void
     */
    protected function find($id, string $attribut = 'id')
    {
        if( isset($id) ){
            $sql = "SELECT * FROM ".$this->table." WHERE ".$attribut." = :".$attribut;
            $param = [ $attribut=> $id ];
        }else{
            $sql = "SELECT * FROM ".$this->table;
            $param = [];
        }
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($param);
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


}