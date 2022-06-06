<?php

namespace App\Core;


class Validator 
{

    public static $form_errors;


    public static function run($config, $data, $unicity)
    {
        if( count($data) != count($config["inputs"]) ){
            $config["inputs"]['error']="Form modified by a user";
        }

        $errors = [];

        foreach ($config["inputs"] as $name => $input){

            if(!isset($data[$name])){
                $config['inputs'][$name]['error'] = "Fields are missing";
            }

            if(!empty($input["required"]) && empty($data[$name])){
                $config['inputs'][$name]['error'] = "You deleted the required attribute";

            }

            if($input["type"]=="password" && self::checkPassword($data[$name])){
                $input['error']="";
            }

            if($input["type"]=="email" ){
                if(!self::checkEmail($data[$name])){
                    $config['inputs']['email']['error'] = "Email incorrect";   
                }elseif($unicity !== false){
                    $config['inputs']['email']['error']="this email alreay exist";
                }
            }

            if(isset($config['inputs']['slug'])  && $unicity !== false){
              
                $config['inputs']['slug']['error']="this slug alreay exist";
    
            }


            if(self::valueEquality($data['password'], $data['passwordConfirm'])){
                $config['inputs']['password']['error'] = "Passwords does not match";
            }

            if(isset($input['min']) && $input['max']){
                if(self::size($data[$name],$input['min'],$input['max'])){
                    $config['inputs'][$name]['error']="size of $name not valide";
                }
            }


            array_push($errors, $config["inputs"][$name]['error'] );
        }

        foreach($errors as $error){
            if(strlen($error) == 0){
                return ;
            }else{
                return $config;
            }
        }

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