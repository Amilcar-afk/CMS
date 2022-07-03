<?php

namespace App\Controller;

use App\Core\Query;
use App\Core\View;
use App\Model\Conversation;
use App\Model\Message;
use App\Model\User;
use App\Model\Projet;
use App\Model\User_conversation;
use App\Model\User_projet;

class Communication
{
    public $project;
    public $conversation;
    public $message;
    public $user;

    public $currentUser;

    protected $project;
    protected $user_project;

    public function __construct()
    {
        $this->project = new Projet();
        $this->conversation = new Conversation();
        $this->message = new Message();
        $this->user = new User();
        $this->user_project = new User_projet();
    }


    public function listConversation()
    {

        $user = new User();
        $user = $user->find($_SESSION['Auth']->id);
        $view = new View("conversation-list", "back");
        $msg = new Message();
        $view->assign("conversations",$user->conversations());
        $view->assign("msg",$msg);


    }

    public function searchData()
    {
        if (isset($_POST['searchData'])) {
            $users = Query::from('cmspf_Users')
            ->or("firstname LIKE '%" . $_POST['searchData'] . "%'")
            ->or("lastname LIKE '%" . $_POST['searchData']. "%'")
            ->or("mail LIKE '%" . $_POST['searchData'] . "%'")
            ->execute("User");
            $conversation_users = [];
            $user = new User();
            $user = $user->find($_SESSION['Auth']->id);
            foreach($user->conversations() as $conversation){
                foreach($conversation->users()as $user){
                    array_push($conversation_users,$user->getId() );
                } 
            } 
            foreach ($users as $user){
                if(in_array($user->getId(),$conversation_users)){
                    continue;
                }
                $allUsers [] = array(
                    'id' => $user->getId(),
                    'email' => $user->getMail(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                );
            }
            echo json_encode($allUsers);
        }

    }

    public function userConversation()
    {
        $data = $this->user->parseUrl();
        $user = $this->user->find($data['id']);
        $view = new View("conversation_user", "back");
        $view->assign("user",$user);

    }


    public function messages()
    {
        if(isset($_POST['id'])){
            $conversation = new Conversation();
            $conversation->setId($_POST['id']);
            
            echo json_encode(array_reverse($conversation->messages()));
        }
    }


    public function composeConversation()
    {
        if (!empty($_POST)) {

            if(!isset($_POST['id_conversation'])){
                $this->conversation->setDate(date('Y-m-d H:i:s'));
                $this->conversation->save();
                $conversationId =  $this->conversation->getLastId();
            }else{
                $conversationId = $_POST['id_conversation'];
            }

            $user_conversation = new User_conversation();
            $my_conversation = new User_conversation();

            $user_conversation->setUser_key($_POST['id_user']);
            $user_conversation->setConversation_key($conversationId);

            $my_conversation->setUser_key($_SESSION['Auth']->id);
            $my_conversation->setConversation_key($conversationId);

            $user_conversation->save();
            $my_conversation->save();

            $this->message->setDate(date('Y-m-d H:i:s'));
            $this->message->setContent($_POST['message']);
            $this->message->setUser_key($_SESSION['Auth']->id);
            $this->message->setConversation_key($conversationId);
            $this->message->save();

        }
    }

    public function listProject()
    {
        $userProject = Query::from('cmspf_Projets')->where('user_key = ' . $_SESSION['Auth']->id)->execute();
        $usersProject = [];

        if(count($userProject) > 0){

            foreach ($userProject as $key => $project) {
                $idProject = $userProject[$key]['id'];
                $this->project->setId($idProject);
                $usersProject[$key] = $this->project->user();
            }

        }

        $view = new View("project-list", "back");

        $projects = $this->project->find();
        $view->assign("projects",$projects);

        $users = new User();
        $users = $users->find();
        $view->assign("users", $users);

        $view->assign("usersProject", $usersProject);

        $projectEmpty = $this->project;
        $view->assign("projectEmpty", $projectEmpty);
    }


    public function composeProject()
    {
        if(!empty($_POST)){

            $view = new View("project-list", "back");
            //$result = Validator::run($this->project->getFormCreateProject(), $_POST,false);

            //if(empty($result)){

            $this->project->setTitle($_POST['title']);
            $this->project->setDescription($_POST['description']);
            $this->project->setUserKey($_SESSION['Auth']->id);
            $this->project->save();

            $idProject = $this->project->getLastId();
            $users = new User();
            $users = $users->find();

            if(!empty($idProject)) {
                $projectUserKeys = explode(",", $_POST['users']);

                foreach ($projectUserKeys as $key => $userKey) {
                    $this->user_project->setUserKey($userKey);
                    $this->user_project->setProjectKey($idProject);
                    $this->user_project->save();
                }

                $projectEmpty = $this->project;
                $projects = $this->project->find();

                $view->assign("projects",$projects);
                $view->assign("users", $users);
                $view->assign("projectEmpty", $projectEmpty);

            }else{
                http_response_code(400);
            }

            /*}else{
                $view->assign("error_from",$result);
            }*/

        }else{
            http_response_code(400);
        }
    }
}