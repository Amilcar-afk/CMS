<?php

namespace App\Controller;
use App\Core\Validator;
use App\Core\View;
use App\Core\Query;

use App\Model\Option as option_model;

class Option{

    public $option;

    public function __construct()
    {
        $this->option = new option_model();
    }

    public function loadOption(){

        $main_color = null;
        $second_color = null;
        $third_color = null;
        $background_color = null;
        $radius = null;
        $bessels = null;


        $main_logo = null;
        $main_favicon = null;


        $options = $this->option->find();

        foreach($options as $option){
            if($option->getType() == 'main_color'){
                $main_color = $option;
            }else if($option->getType() == 'second_color'){
                $second_color = $option;
            }else if($option->getType() == 'third_color'){
                $third_color = $option;
            }else if($option->getType() == 'background_color'){
                $background_color = $option;
            }else if($option->getType() == 'radius'){
                $radius = $option;
            }else if($option->getType() == 'bessels'){
                $bessels = $option;
            }else if($option->getType() == 'logo'){
                $logo = $option;
            }else if($option->getType() == 'favicon'){
                $favicon = $option;
            }
            
            // else if($option->getType() == 'main_logo'){
            //     $main_logo = $option;
            // }else if($option->getType() == 'main_favicon'){
            //     $main_favicon = $option;
            // }
        }
        $view = new View("style", "back");
        $view->assign("main_color", $main_color);
        $view->assign("second_color", $second_color);
        $view->assign("third_color", $third_color);
        $view->assign("background_color", $background_color);
        $view->assign("radius", $radius);
        $view->assign("bessels", $bessels);
        $view->assign("logo", $logo);
        $view->assign("favicon", $favicon);


        // $view->assign("main_logo", $main_logo);
        // $view->assign("main_favicon", $main_favicon);



    }

    public function composeOption()
    {
        if( (isset($_POST) && isset($_POST['value'])) || isset($_FILES)) {

            $option = Query::from('cmspf_Options')
                ->where("type = '" . $_POST['type'] . "'")
                ->execute('Option');

            if(isset($_FILES) && in_array($_POST['type'], ['logo', 'favicon', 'font']) ){
                if (isset($_FILES["file"]['name'])) {
                    $tailleMax = 2097152;
                    $authExt = array('jpg','jpeg','png','svg');
                    if($_FILES["file"]['size'] <= $tailleMax) {
                        $extensionUpload = strtolower(substr(strrchr($_FILES["file"]['name'], '.'), 1));
                        if(in_array($extensionUpload, $authExt)) {
                            $chemin = realpath(dirname(__FILE__))."/../style/medias/logos/cust-" . $_POST['type'] . ".".$extensionUpload;
                            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $chemin);
                            if ($move) {

                                $this->option->setPath("/style/medias/logos/cust-" . $_POST['type'] . ".".$extensionUpload);

                            }else{
                                return "Error importing";
                            }
                        }else{
                            return "Format invalid";
                        }
                    }else{
                        return "Invalid size";
                    }
                }else{
                    return;
                }
            }else{
                if( isset($_POST) && in_array($_POST['type'], ['main_color', 'second_color', 'third_color', 'background_color'])
                    && preg_match('/^#[a-f0-9]{6}$/i', $_POST['value'])){

                    $error = true;

                }elseif(true){

                }
                $this->option->setValue($_POST['value']);
            }

            if (!isset($error)) {
                if (isset($option[0])) {
                    $this->option->setId($option[0]->getId());
                }
                $this->option->setType($_POST['type']);
                $this->option->setUserKey($_SESSION['Auth']->id);
                $this->option->save();

                $mainColor = Query::from('cmspf_Options')
                    ->where("type = 'main_color'")
                    ->execute('Option');

                $secondColor = Query::from('cmspf_Options')
                    ->where("type = 'second_color'")
                    ->execute('Option');

                $thirdColor = Query::from('cmspf_Options')
                    ->where("type = 'third_color'")
                    ->execute('Option');

                $backgroundColor = Query::from('cmspf_Options')
                    ->where("type = 'background_color'")
                    ->execute('Option');

                $radius = Query::from('cmspf_Options')
                    ->where("type = 'radius'")
                    ->execute('Option');

                $bessels = Query::from('cmspf_Options')
                    ->where("type = 'bessels'")
                    ->execute('Option');
                return include "View/Partial/design-variables.partial.php";
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(500);
        }



        // if(!isset($_POST['id']) && !(!isset($_FILES['main_favicon']) || !isset($_FILES['main_logo']))){
        // else if(isset($_FILES['main_logo']) || isset($_FILES['main_favicon'])){
        //     if(isset($_FILES['main_logo']) ){
        //         $tmpName = $_FILES['main_logo']['tmp_name'];
        //         $name = $_FILES['main_logo']['name'];
        //         $type = 'main_logo';
        //     }else{
        //         $tmpName = $_FILES['main_favicon']['tmp_name'];
        //         $name = $_FILES['main_favicon']['name'];
        //         $type = 'main_favicon';
        //     }

        //     move_uploaded_file($tmpName, "./style/images/photos/".$name);

        //     $this->option->setPath($tmpName);
        //     $this->option->setType($type);
        //     $this->option->setUserKey($id_user);
        //     $this->option->save();
        //     header('location:/settings/style');
        // }

    }
}