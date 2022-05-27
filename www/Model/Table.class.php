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
        return parent::findAllData($sql, $param);
    }

    public function getTableUsers(): array 
    {   
        return [

            "table" => [
                "class" => "display",
                "id" => "usersTab"
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
                "Rang",
                "",
                ""
            ]

        ];
    }

}