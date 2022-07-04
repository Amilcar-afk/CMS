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
        $text_color = null;
        $radius = null;
        $bessels = null;


        $main_logo = null;
        $main_favicon = null;


        $options = $this->option->find();

        $fonts = Query::from('cmspf_Options')
            ->where("type = 'font'")
            ->execute('Option');

        $view = new View("style", "back");
        $view->assign("fonts", $fonts);

        foreach($options as $option){
            if($option->getType() == 'main_color'){
                $main_color = $option;
                $view->assign("main_color", $main_color);
            }else if($option->getType() == 'second_color'){
                $second_color = $option;
                $view->assign("second_color", $second_color);
            }else if($option->getType() == 'third_color'){
                $third_color = $option;
                $view->assign("third_color", $third_color);
            }else if($option->getType() == 'background_color'){
                $background_color = $option;
                $view->assign("background_color", $background_color);
            }else if($option->getType() == 'text_color'){
                $text_color = $option;
                $view->assign("text_color", $text_color);
            }else if($option->getType() == 'radius'){
                $radius = $option;
                $view->assign("radius", $radius);
            }else if($option->getType() == 'bessels'){
                $bessels = $option;
                $view->assign("bessels", $bessels);
            }else if($option->getType() == 'logo'){
                $logo = $option;
                $view->assign("logo", $logo);
            }else if($option->getType() == 'favicon'){
                $favicon = $option;
                $view->assign("favicon", $favicon);
            }
        }

    }

    public function composeOption()
    {
        if( (isset($_POST) && isset($_POST['value'])) || isset($_FILES)) {

            if ($_POST['type'] != 'font') {
                $option = Query::from('cmspf_Options')
                    ->where("type = '" . $_POST['type'] . "'")
                    ->execute('Option');
            }
            if(isset($_FILES) && in_array($_POST['type'], ['logo', 'favicon', 'font']) ){
                if (isset($_FILES["file"]['name'])) {
                    $tailleMax = 2097152;

                    if($_POST['type'] == 'font'){
                        $authExt = array('ttf', 'otf');
                        $startPath = "/style/medias/fonts/".str_replace(strtolower(substr(strrchr($_FILES["file"]['name'], '.'), 0)), "", strtolower($_FILES["file"]['name']));
                        $this->option->setValue(str_replace(strtolower(substr(strrchr($_FILES["file"]['name'], '.'), 0)), "", strtolower($_FILES["file"]['name'])));
                    }else{
                        $authExt = array('jpg','jpeg','png','svg');
                        $startPath = "/style/medias/logos/cust-". $_POST['type'];
                    }
                    if($_FILES["file"]['size'] <= $tailleMax) {
                        $extensionUpload = strtolower(substr(strrchr($_FILES["file"]['name'], '.'), 1));
                        if(in_array($extensionUpload, $authExt)) {
                            $chemin = realpath(dirname(__FILE__))."/..". $startPath . ".".$extensionUpload;
                            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $chemin);
                            if ($move) {

                                $this->option->setPath($startPath . ".".$extensionUpload);

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
            }else {
                if (in_array($_POST['type'], ['main_color', 'second_color', 'third_color', 'background_color', 'font_color'])){
                    if (preg_match('/^#[a-f0-9]{6}$/i', $_POST['value'])) {
                        $this->option->setValue($_POST['value']);
                    } else{
                        $error = false;
                    }
                }else{
                    $this->option->setValue($_POST['value']);
                }
            }

            if (!isset($error)) {
                if (isset($option[0])) {
                    $this->option->setId($option[0]->getId());
                }
                $this->option->setType($_POST['type']);
                $this->option->setUserKey($_SESSION['Auth']->id);
                $this->option->save();

                $fonts = Query::from('cmspf_Options')
                    ->where("type = 'font'")
                    ->execute('Option');

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

    }

    public function composeImg()
    {
        if( isset($_FILES) && isset($_FILES['file'])) {
            if (isset($_FILES["file"]['name'])) {
                $tailleMax = 2097152;

                $authExt = array('jpg','jpeg','png','svg');
                $startPath = "/style/medias/images/cust-". date('Ymd-H-m-s');

                if($_FILES["file"]['size'] <= $tailleMax) {
                    $extensionUpload = strtolower(substr(strrchr($_FILES["file"]['name'], '.'), 1));
                    if(in_array($extensionUpload, $authExt)) {
                        $chemin = realpath(dirname(__FILE__))."/..". $startPath . ".".$extensionUpload;
                        $move = move_uploaded_file($_FILES["file"]["tmp_name"], $chemin);
                        if ($move) {

                            $this->option->setPath($startPath . ".".$extensionUpload);
                            $this->option->setType('image');
                            $this->option->setUserKey($_SESSION['Auth']->id);
                            $this->option->save();

                            echo $startPath . ".".$extensionUpload;
                        }else{
                            echo "Error importing";
                        }
                    }else{
                        echo "Format invalid";
                    }
                }else{
                    echo "Invalid size";
                }
            }else{
                echo "Error1";
            }
        }else{
            echo "Error2";
        }

    }
}