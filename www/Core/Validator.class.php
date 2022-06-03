<?php

namespace App\Core;

use App\Core\CheckInputs;
use App\Core\BaseSQL;



class Validator extends BaseSQL
{

    public function __construct()
    {
        parent::__construct();
    }


    public static function run($config, $data): array
    {
        if( count($data) != count($config["inputs"]) ){
            $config["inputs"]['error']="Form modified by a user";
        }
        foreach ($config["inputs"] as $name=>$input){

            if(!isset($data[$name])){
                $input['error']="Fields are missing";
            }
            if(!empty($input["required"]) && empty($data[$name])){
                $input['error']="You deleted the required attribute ";
            }
            if($input["type"]=="password" && self::checkPassword($data[$name])){
                $input['error']="";
            }else if($input["type"]=="email"  && !self::checkEmail($data[$name])){
                $input['error']="Email incorrect";
            }
            if(self::valueEquality($data['password'], $data['passwordConfirm'])){
                $input['error']="Password does not match confirmation";
            }
            
            if(isset($input['min']) && $input['max']){
                if(!self::size($data[$name],$input['min'],$input['max'])){
                    $input['error']="size of $name no valide";
                }
            }




            return $config;

        }
    }

  

    public function  checkEmailUnicity($email)
    {
         parent::find($email,'mail');
        // return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    //les errurs en anglais

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