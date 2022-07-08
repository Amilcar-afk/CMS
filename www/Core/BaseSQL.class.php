<?php

namespace App\Core;


abstract class BaseSQL
{
    private $pdo;
    private $table;
    private $class;
    private $lastInsertId;
    private static $bdd;
    public $urlData;

    private static $dbStatus = true;

    /**
     * @return \PDO
     */
    public function getPdo()
    {
        return self::$bdd ;

    }

    /**
     * @return mixed
     */
    public static function getDStatus()
    {
        return self::$dbStatus;
    }

    /**
     * @param mixed $dbStatus
     */
    public static function setDbStatus($status): void
    {
        self::$dbStatus = $status;
    }

    private static function getBdd()
    {
        if(file_exists('env.json') ){
            $envFile= 'env.json';
            $json_data = file_get_contents($envFile);
            $config = json_decode($json_data, true);
            if(self::$bdd === null){
                
                try{
                    self::$bdd = new \PDO("mysql:host=".$config['env'][0]['DBHOST'].";port=".$config['env'][0]['DBPORT'].";dbname=".$config['env'][0]['DBNAME'] ,$config['env'][0]['DBUSER'] ,$config['env'][0]['DBPWD'] );
                    self::$bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                    self::$bdd->setAttribute(\PDO::ATTR_TIMEOUT, 1);
                }catch(\Exception $e){
                    self::setDbStatus(false);
                }
            }
        }
        if (self::getDStatus() != false) {
            return self::$bdd;
        }elseif ($_SERVER['REQUEST_URI'] != '/setup/database') {
            header('location:/setup/database');
        }
    }       

    public function __construct()
    {
        self::getBdd();

        $class = explode("\\",get_called_class());
        $this->class = end($class);
        if(isset($this->table_name)){
            $this->table = $this->table_name;
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
        $queryPrepared = self::$bdd->prepare($sql);
        $queryPrepared->execute($columns);

        $stmt = self::$bdd->query("SELECT LAST_INSERT_ID()");
        if( !is_null($this->getId()) ){
            $lastInsertd = $this->getId();
        }else{
            $lastInsertd = $stmt->fetchColumn();
        }
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

    /**
     * Delete element by id
     * @return void
     */
    protected function delete($id)
    {
        if( !is_null($this->getId()) ){
            $sql = "DELETE  FROM ".$this->table." WHERE id=".$this->getId();
            $queryPrepared = self::$bdd->prepare($sql);
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
            $queryPrepared = self::$bdd->prepare($sql);
            $queryPrepared->execute($param);
            return $queryPrepared->fetchObject("App\Model\\".$this->class);
        }else{
            $sql = "SELECT * FROM ".$this->table;
            $param = [];
            $queryPrepared = self::$bdd->prepare($sql);
            $queryPrepared->execute($param);
            return $queryPrepared->fetchAll(\PDO::FETCH_CLASS, "App\Model\\".$this->class);
        }
    }


    /**
     * @param $class
     * @param string|null $foreign_key
     * @return array|false
     */
    protected function hasMany( $class, string $foreign_key = null)
    {
        $class = explode("\\", $class);
        $class = end($class);
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

        $queryPrepared = self::$bdd->prepare($sql);

        $queryPrepared->execute($param);

        return $queryPrepared->fetchAll(\PDO::FETCH_CLASS, "App\Model\\".$class);
    }

    /**
     * @return false|string[]
     */
    public function getClass()
    {
        return $this->class;
    }


    /**
     * @param $class
     * @param string|null $foreign_key
     * @param string $owner_key
     * @return false|mixed|object|\stdClass|null
     */
    protected function belongsTo( $class, string $foreign_key = null, string $owner_key = "id")
    {

        $class = explode("\\", $class);
        $class = end($class);
        if(isset($class->table_name)){
            $targetTable = $class->table_name;
        }else{
            $targetTable = DBPREFIXE.($class).'s';
        }
        

        if (!isset($foreign_key)){
            $foreign_key = lcfirst($class)."_key";
        }

        $sql = "SELECT * FROM ".$targetTable." WHERE ".$owner_key." = :".$owner_key;


        
        $param = [
            $owner_key => $foreign_key
        ];
        
        
        $queryPrepared = self::$bdd->prepare($sql);
        
        
        
        $queryPrepared->execute($param);
        var_dump($foreign_key);
        return $queryPrepared->fetchObject("App\Model\\".$class);
    }

    /**
     * @param $class
     * @param string|null $relationTable
     * @param string $owner_key
     * @param string $foreign_key
     * @param string|null $relation_foreign_key
     * @return array|false
     */
    protected function belongsToMany( $class, string $relationTable = null, string $owner_id_name = "id", string $target_id_name = "id", string $relation_foreign_key = null, string $relation_target_key = null, $negation = '')
    {
        $class = explode("\\", $class);
        $class = end($class);

        if(isset($class->table_name)){
            $targetTable = $class->table_name;
        }else{
            $targetTable = DBPREFIXE.($class).'s';
        }
        if (!isset($relation_target_key)) {
            $relation_target_key = lcfirst($class) . "_key";
        }
        if (!isset($relation_foreign_key)){
            $relation_foreign_key = lcfirst($this->class)."_key";
        }
        
        //$sql = "SELECT * FROM cmspf_Categories WHERE id IN ( SELECT cmspf_Page_categorie.categorie_key FROM cmspf_Page_categorie INNER JOIN cmspf_Pages ON cmspf_Page_categorie.page_key = cmspf_Pages.id WHERE cmspf_Pages.id = 1)"
        if($negation != 'NOT')
            $sql = "SELECT * FROM ".$targetTable." WHERE ".$target_id_name." IN ( SELECT ".$relationTable.".".$relation_target_key." FROM ".$relationTable." INNER JOIN ".$this->table." ON ".$relationTable.".".$relation_foreign_key." = ".$this->table.".".$owner_id_name." WHERE ".$this->table.".".$owner_id_name." = :".$owner_id_name.")";
        else
            $sql = "SELECT * FROM ".$targetTable." WHERE ".$target_id_name." NOT IN ( SELECT ".$relationTable.".".$relation_target_key." FROM ".$relationTable." INNER JOIN ".$this->table." ON ".$relationTable.".".$relation_foreign_key." = ".$this->table.".".$owner_id_name." WHERE ".$this->table.".".$owner_id_name." = :".$owner_id_name.")";
        $param = [
            $owner_id_name => $this->id
        ];

        $queryPrepared = self::$bdd->prepare($sql);

        $queryPrepared->execute($param);
        return $queryPrepared->fetchAll(\PDO::FETCH_CLASS, "App\Model\\".$class);
    }

}


// SELECT * FROM cmspf_Conversations WHERE id IN ( SELECT cmspf_User_conversation.id FROM cmspf_User_conversation INNER JOIN cmspf_Users ON cmspf_User_conversation.id = cmspf_Users.id WHERE cmspf_Users.id = 1)