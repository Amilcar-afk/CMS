<?php

namespace App\Core;


abstract class BaseSQL
{
    private $pdo;
    private $table;

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

        if(isset($this->table_name)){
            $this->table = $this->table_name;
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
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
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
    }

    /**
     * Delete element by id
     * @return void
     */
    protected function delete($id)
    {
        if( !is_null($this->getId()) ){
            $sql = "DELETE * FROM ".$this->table." WHERE id=".$this->getId();

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
    protected function find($id = null, string $attribut = 'id')
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
     * @param $class
     * @param string|null $foreign_key
     * @return array|false
     */
    protected function hasMany( $class, string $foreign_key = null)
    {
        if(isset($class->table_name)){
            $targetTable = $class->table_name;
        }else{
            $targetTable = DBPREFIXE.($class).'s';
        }

        if (!isset($foreign_key)){
            $classExploded = explode("\\",get_called_class());
            $foreign_key = lcfirst(end($classExploded))."_key";
        }

        $sql = "SELECT * FROM ".$targetTable." WHERE ".$foreign_key." = :".$foreign_key;
        $param = [
            $foreign_key => $this->id
        ];

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($param);
        $res = $queryPrepared->fetchAll(\PDO::FETCH_CLASS, "App\Model\\".$class);
        return $res;
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