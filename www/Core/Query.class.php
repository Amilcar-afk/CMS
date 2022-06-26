<?php

namespace App\Core;

use App\Core\BaseSQL;

class Query extends BaseSQL
{
    private static $select = [];
    private static $delete = [];
    private static $from;
    private static $where = [];
    private static $or = [];
    private static $order;
    private static $limit = '';
    private static $params = [];
    private static $class;
    private static $groupBy = '';

    public function __construct()
    {
        parent::__construct();
        $this->pdo = parent::getPdo();
    }

    public static function __callStatic($method, $arguments)
    {
        $query = new Query();
        return call_user_func_array([$query, $method], $arguments);
    }

    public function from(string $table, ?string $alias = null)
    {
        if ($alias){
             self::$from[$alias] = $table;
        }else {
             self::$from[] = $table;
        }

         return (new Query);
    }

    public function select(string ...$fields): self
    {
        self::$select = $fields;
        return (new Query);
    }

    public function deleteAll(string ...$fields): self
    {
        self::$delete = $fields;
        return (new Query);
    }

    public function where(string ...$condition): self
    {
        self::$where = array_merge(self::$where, $condition);
        return (new Query);
    }

    public function or(string ...$condition): self
    {
        self::$or = array_merge(self::$or, $condition);
        return (new Query);
    }

    public function limit(string $from, string $to = null): self
    {
        if(!empty($to)){
            if(DBDRIVER === "mysql"){
                self::$limit = " LIMIT " . $from . ", " . $to;
            }elseif (DBDRIVER === "pgsql"){
                self::$limit = " LIMIT " . $from . " OFFSET " . $to;
            }
        }else {
            self::$limit = " LIMIT " . $from;
        }

        return (new Query);
    }

    public function count(string ...$condition): int
    {
        self::select("COUNT(id)");
        return self::execute()->fetchColumn();
    }

    public function groupBy(string $group): self 
        {
            self::$groupBy = "GROUP BY ". $group;
            return (new Query);
        }

    public function params(array $params): self
    {
        self::$params = $params;
        return (new Query);
    }

    public function __toString()
    {
        if (self::$delete)
        {
            $parts = ['DELETE'];
        }elseif (self::$select)
        {
            $parts = ['SELECT'];
            $parts[] = join(', ', self::$select);
        }else{
            $parts = ['SELECT'];
            $parts[] = '*';
        }

        $parts[] = 'FROM';
        $parts[] = self::constructFrom();

        if (!empty(self::$where)){
            $parts[] = "WHERE";
            $parts[] = '(' . join(') AND (', self::$where) . ')';
        }

        if (!empty(self::$or)){
            if(array_search("WHERE", $parts) === false){
                $parts[] = "WHERE";
            }

            if (!empty(self::$where))
                $parts[] = ' AND (' . join(' OR ', self::$or) . ')';
            else
                $parts[] = ' (' . join(' OR ', self::$or) . ')';


            if (!empty(self::$limit))
                $parts[] = self::$limit ;
            
            if (!empty(self::$groupBy))
                $parts[] = self::$groupBy ;
        }

        return join(' ', $parts);
    }

    private function constructFrom(): string
    {
        $from = [];
        foreach (self::$from as $key => $value) {
            if (is_string($key)){
                $from[] = "$value as $key";
            }else{
                $from[] = $value;
            }
        }
        return join(', ', $from);
    }

    public function execute($model = null)
    {
        $query = $this->__toString();
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        self::$params = [];
        self::$select = [];
        self::$delete = [];
        self::$from = [];
        self::$where = [];
        self::$or = [];
        self::$groupBy = [];
        self::$limit = [];
        if ($model != null) {
            return $statement->fetchAll(\PDO::FETCH_CLASS, "App\Model\\" . $model);
        }
        return $statement->fetchAll();
    }

}