<?php

namespace App\Model;

use App\Core\BaseSQL as BaseSQL;

class Table extends BaseSQL
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectAllUsers($sql, $param){
        parent::findAllData($sql, $param);
    }

    public function getTableUsers(): array 
    {   
        return [

            "table" => [
                "class" => "table-element",
                "id" => "UsersTab"
            ],

            "title" => "Utilisateurs",

            "colTitle" => [
                "ID", 
                "Nom", 
                "Prénom",
                "Email",
                "Date de création du compte",
                "Date de mise à jour du compte",
                "Etat du compte",
                "Rang"
            ]

        ];
    }

}