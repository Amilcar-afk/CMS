<?php

namespace App\Core;

use App\Core\BaseSQL;

class Query extends BaseSQL
{
    private static $select = [];
    private static $from;
    private static $where = [];
    private static $order;
    private static $limit;
    private static $params = [];

    public function __construct()
    {
        parent::__construct();
        $this->pdo = parent::getPdo();
        $this->class = parent::getClass();
    }

    public static function __callStatic($method, $arguments)
    {
        $query = new Query();
        return call_user_func_array([$query, $method], $arguments);
    }

    public function from(string $table, ?string $alias = null): self
    {
        if ($alias){
            self::$from[$alias] = $table;
        }else {
            self::$from[] = $table;
        }
        return self;
    }

    public function select(string ...$fields): self
    {
        self::$select = $fields;
        return self;
    }

    public function where(string ...$condition): self
    {
        self::$where = array_merge(self::$where, $condition);
        return self;
    }

    public function count(string ...$condition): int
    {
        self::select("COUNT(id)");
        return self::execute()->fetchColumn();
    }

    public function params(array $params): self
    {
        self::$params = $params;
        return self;
    }

    public function __toString()
    {
        $parts = ['SELECT'];
        if (self::$select)
        {
            $parts[] = join(', ', self::$select);
        }else{
            $parts[] = '*';
        }

        $parts[] = 'FROM';
        $parts[] = self::constructFrom();

        if (!empty(self::$where)){
            $parts[] = "WHERE";
            $parts[] = '(' . join(') AND (', self::$where) . ')';
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

    public function execute()
    {
        $query = self::__toString();
        $statement = self::$pdo->prepare($query);
        $statement->execute();
        //return $this->class;
        return $statement->fetchAll(\PDO::FETCH_CLASS, "App\Model\Page");
    }

}