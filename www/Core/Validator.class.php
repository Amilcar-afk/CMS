<?php
namespace App\Core;
use App\Core\CheckInputs;


class Validator
{

    public static function run($config, $data): array
    {
        $result = [];
        
        if( count($data) != count($config["inputs"]) ){
            $result[]="Formulaire modifié par user";
        }
        foreach ($config["inputs"] as $name=>$input){
            if(!isset($data[$name])){
                $result[]="Il manque des champs";
            }
            if(!empty($input["required"]) && empty($data[$name])){
                $result[]="Vous avez supprimé l'attribut required";
            }
            if($input["type"]=="password" && !CheckInputs::checkPassword($data[$name])){
                $result[]="Password incorrect";
            }else if($input["type"]=="email"  && !self::checkEmail($data[$name])){
                $result[]="Email incorrect";
            }
            if(CheckInputs::valueEquality($data['password'], $data['passwordConfirm'])){
                $result[]="Password ne correspond pas au la confirmation";
            }
        }
        return $result;
    }

    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}