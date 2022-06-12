<?php

namespace App\Controller;
use App\Core\View;
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


        // $view->assign("main_logo", $main_logo);
        // $view->assign("main_favicon", $main_favicon);



    }

    public function composeOption()
    {
        $id_user = $_SESSION['Auth']->id;
        if(!isset($_POST['id'])){
            $this->option->setValue($_POST['value']);
            $this->option->setType($_POST['type']);
            $this->option->setUserKey($id_user);
            $this->option->save();
        }
        else{
            $this->option->setId($_POST['id']);
            $this->option->setValue($_POST['value']);
            $this->option->setType($_POST['type']);
            $this->option->setUserKey($id_user);
            $this->option->save();
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