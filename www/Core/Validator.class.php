<?php

namespace App\Core;

use DateTime;

class Validator 
{

    public static $form_errors;


    public static function run($config, $data, $unicity =null)
    {


        if( count($data) != count($config["inputs"]) ){
            $config["inputs"]['error']="Form modified by a user";
        }

        $errors = [];

        if(isset($config['inputs']['slug'])  && $unicity !== false){
            $config['inputs']['slug']['error']="This slug alreay exist";
        }

        if(isset($config['inputs']['passwordConfirm'])
            && isset($config['inputs']['password'])
            && self::valueEquality($data['password'], $data['passwordConfirm'])){
            $config['inputs']['password']['error'] = "Passwords does not match";
        }

        foreach ($config["inputs"] as $name => $input){

            if(isset($input["name"]) &&  $input["name"] == "id"){
                continue;
            }

   
            if(isset($input["name"]) && $input["name"] == "Categorie"){
                continue;
            }


            if(!isset($data[$name])){
                $config['inputs'][$name]['error'] = "Fields are missing";
            }


            if(!empty($input["required"]) && empty($data[$name])){
                $config['inputs'][$name]['error'] = "You deleted a required input";

            }

            if($input["type"]=="password" && self::checkPassword($data[$name])){
                $input['error']="";
            }

            if($input["type"]=="email" ){
                if(!self::checkEmail($data[$name])){
                    $config['inputs']['email']['error'] = "Bad Email";
                }elseif($unicity !== false){
                    $config['inputs']['email']['error']="This email alreay exist";
                }
            }

            if($input["type"]=="date" ){
                if(!self::validateDate($data[$name])){
                    $config['inputs']['email']['error'] = "Bad Date";
                }
            }

            if(isset($input['min']) && isset($input['max'])){
                if(self::size($data[$name],$input['min'],$input['max'])){
                    $config['inputs'][$name]['error']="Min ".$input['min']." and max ".$input['max']." caracteres";
                
                }
            }
            
            array_push($errors, $config["inputs"][$name]['error'] );
        }


        foreach($errors as $error => $e ){
            if(strlen($e) == 0){
                unset($errors[$error]);
            }
        }
        if(empty($errors)){
            return ;
        }else{
            return $config;
        }
     

    }




    public static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $currentDate = DateTime::createFromFormat($format, $date);
        return $currentDate && $currentDate->format($format) == $date;
    }


    public static function size($value, $minSize, $maxSize)
    {
        if (strlen($value) < $minSize || strlen($value) > $maxSize) {
            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function checkPassword($value)
    {
        echo '<br>';
        //mdp = 8 char dont 1 lettre maj, 1 lettre min et 1 chiffre
        if (strlen($value) > 10
        && preg_match('#[a-z]#', $value)
        && preg_match('#[A-Z]#', $value)
        && preg_match('#[0-9]#', $value)
        && preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)
        ) {
            return true;
        }

        return false;
    }

    public static function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) { //:bool
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @param $value
     * @param $cValue
     * @return bool
     */
    public static function valueEquality($value, $cValue){

        if ($value != $cValue) {
            return true;
        }
        return false;
    }


}