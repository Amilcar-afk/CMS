<?php


namespace App\Core;


class CheckInputs
{

    /**
     * @param $value
     * @return bool
     */
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
