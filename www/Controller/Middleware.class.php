<?php
namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\Query;
use App\Core\View;


class Middleware extends BaseSQL {

    public static function auth(){
        if (parent::getDStatus() != false) {
            if (!empty($_SESSION['Auth']->token) && !empty($_SESSION['Auth']->id)) {

                $user = Query::from('cmspf_Users')
                    ->where("id = :id")
                    ->where("confirm = '1'")
                    ->where("deleted IS NULL")
                    ->params(["id" => $_SESSION['Auth']->id])
                    ->execute("User");

                if (!isset($user[0])) {
                    header('location:/login');
                }

                if ($user[0]->getToken() != $_SESSION['Auth']->token) {
                    header('location:/login');
                }

                $_SESSION['Auth']->rank = $user[0]->getRank();
            }

            if (!isset($_SESSION['Auth']->rank)) {
                if ($_SERVER['REQUEST_URI'] !== '/logout' && $_SERVER['REQUEST_URI'] !== '/login') {
                    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
                    header('location:/login');
                }
            }
        }
    }

    public static function admin(){
        if (parent::getDStatus() != false) {
            if (isset($_SESSION['Auth']) && $_SESSION['Auth']->rank != 'admin') {
                http_response_code(403);
                $view = new View("error", 'back-sandbox');
                $view->assign("metaData", $metaData = [
                    "title" => 'Error',
                    "description" => 'Error',
                ]);

                die();
                //header('location:/login');
            }
        }
    }

}