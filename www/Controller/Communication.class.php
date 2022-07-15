<?php

namespace App\Controller;

use App\Core\Query;
use App\Core\View;
use App\Model\Conversation;
use App\Model\Message;
use App\Model\Step;
use App\Model\User;
use App\Model\Projet;
use App\Model\User_conversation;
use App\Model\User_projet;

class Communication
{
    public $conversation;
    public $message;
    public $user;
    public $currentUser;
    protected $project;
    protected $user_project;
    protected $step;
    public $conversation_user;

    public function __construct()
    {
        $this->project = new Projet();
        $this->conversation = new Conversation();
        $this->message = new Message();
        $this->user = new User();
        $this->user_project = new User_projet();
        $this->step = new Step();
        $this->conversation_user = new User_conversation();

    }


    public function listConversation()
    {

        $user = new User();
        $user = $user->find($_SESSION['Auth']->id);
        $view = new View("conversation-list", "back");
        $msg = new Message();
        $userConversation = new User_conversation();

        $view->assign("conversations",$user->conversations());
        $view->assign("msg",$msg);
        $view->assign("userConversation",$userConversation);
        $view->assign("metaData", $metaData = [
            "title" => 'Conversations',
            "description" => 'Your conversations',
            "src" => [
                ["type" => "js", "path" => "/style/js/searchConversation.js"],
            ],
        ]);
    }


    public function searchData()
    {
        if (isset($_POST['searchData'])) {
            if($_SESSION['Auth']->rank == 'admin'){

                $users = Query::from('cmspf_Users')
                ->where("confirm =". 1)
                ->where("deleted IS NULL")
                ->or("firstname LIKE '%" . $_POST['searchData'] . "%'")
                ->or("lastname LIKE '%" . $_POST['searchData']. "%'")
                ->or("mail LIKE '%" . $_POST['searchData'] . "%'")
                ->execute("User");

            }else{
                $users = Query::from('cmspf_Users')
                ->where("rank = 'admin'")
                ->where("confirm =". 1)
                ->where("deleted IS NULL")
                ->or("firstname LIKE '%" . $_POST['searchData'] . "%'")
                ->or("lastname LIKE '%" . $_POST['searchData']. "%'")
                ->or("mail LIKE '%" . $_POST['searchData'] . "%'")
                ->execute("User");
            }

            $user = new User();
            $user = $user->find($_SESSION['Auth']->id);

            $conversation_users = [];

            foreach($user->conversations() as $conversation){
                foreach($conversation->users() as $user){
                    if($user->getId() != $_SESSION['Auth']->id){
                        $conversation_users[] = array(
                            'id' => $user->getId(),
                            'conversation_id' => $conversation->getId()
                        );
                    }
                } 
            } 

            foreach ($users as $user){
                $allUsers [] = array(
                    'id' => $user->getId(),
                    'email' => $user->getMail(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                );
            }

            echo json_encode([$allUsers,$conversation_users] );
        }
    }

    public function userConversation($dataFromUrl)
    {


        
        if($dataFromUrl['id_conv']){
            
            $idConversation = $dataFromUrl['id_conv'];

            $user_conversation_data = Query::from('cmspf_User_conversation')
            ->where('conversation_key = '.$dataFromUrl['id_conv'])
            ->execute();

            // var_dump($user_conversation_data);
    
            foreach($user_conversation_data as $conversation){
                if($conversation['user_key'] != $_SESSION['Auth']->id){
                    $userId = $conversation['user_key'];
                    $conversation_user = $user_conversation_data[0]['id'] ;
                }else{
                    $seen = $conversation['seen'];
                    $conversation_user = $user_conversation_data[1]['id'] ;
                }
            } 

            $conversations = new Conversation();
            $conversations->setId($dataFromUrl['id_conv']);
            
            $user = $this->user->find($userId);
            $view = new View("conversation_user", "back");
            $view->assign("user",$user);
            $view->assign("conversation",$conversations->messages());
            $view->assign("seen",$seen);
            $view->assign("idConversation",$idConversation);
            $view->assign("conversation_user",$conversation_user);


            $view->assign("metaData", $metaData = [
                "title" => 'Conversation',
                "description" => 'Your conversation',
                "src" => [
                    ["type" => "js", "path" => "/style/js/searchConversation.js"],
                ],
            ]);

        }
    }


    public function test ()
    {
        echo '12';
    }

    public function updateSeenStatus()
    {
        if($_POST['conversation_user_id']){
            $this->conversation_user->setId($_POST['conversation_user_id']);
            $this->conversation_user->setSeen(2);
            $this->conversation_user->save();
        }
    }

    public function messages()
    {
        if(isset($_POST['id'])){
            $conversation = new Conversation();
            $conversation->setId($_POST['id']);
            echo json_encode(array_reverse($conversation->messages()));
        }
    }

    public function newMessage(){
        $lastMessage = Query::from('cmspf_Messages')
        ->where('conversation_key ='.$_POST['id_conv'])
        ->where('id >='.$_POST['id'])
        ->execute();
        echo json_encode(array_reverse($lastMessage));
    }

    public function newConversation()
    {
        $user = new User();
        $currentUser = $user->find($_POST['userId']);
     
        if($currentUser->getConfirm() == 1 &&  $currentUser->getDeleted() != 1){
            $this->conversation->setDate(date('Y-m-d H:i:s'));
            $this->conversation->save();
            $conversationId =$this->conversation->getLastId();
            echo json_encode($this->conversation->getLastId());
            $user_conversation = new User_conversation();
            $my_conversation = new User_conversation();
            $user_conversation->setUser_key($_POST['userId']);
            $user_conversation->setConversation_key($conversationId);
            $my_conversation->setUser_key($_SESSION['Auth']->id);
            $my_conversation->setConversation_key($conversationId);
            $user_conversation->save();
            $my_conversation->save();
        }
        
    }


    public function composeConversation()
    {
        if (!empty($_POST)) {
            $conversationId = $_POST['id_conversation'];

            $user_conversation = Query::from('cmspf_User_conversation')
            ->where('conversation_key='.$conversationId)
            ->where('user_key='.$_POST['id_user'])
            ->execute();

            $my_conversation = Query::from('cmspf_User_conversation')
            ->where('conversation_key='.$conversationId)
            ->where('user_key='.$_SESSION['Auth']->id)
            ->execute();
            
            $user_conv = new User_conversation();
            $user_conv->setId($user_conversation[0]['id']);
            $user_conv->setUser_key($user_conversation[0]['user_key']);
            $user_conv->setSeen(1);
            $user_conv->save();

            $my_conv = new User_conversation();
            $my_conv->setId($my_conversation[0]['id']);
            $my_conv->setUser_key($_SESSION['Auth']->id);
            $my_conv->setSeen(2);
            $my_conv->save();

            $this->message->setDate(date('Y-m-d H:i:s'));
            $this->message->setContent($_POST['message']);
            $this->message->setUser_key($_SESSION['Auth']->id);
            $this->message->setConversation_key($conversationId);
            $this->message->save();
        }
    }

    public function listProject()
    {
        $view = new View("project-list", "back");
        $user = new User();
        $user = $user->find($_SESSION['Auth']->id);
        $view->assign("projects", $user->projects());

        $view->assign(
            "usersProject",
            Query::from('cmspf_Users')
                ->where("deleted IS NULL")
                ->where("id != " . $_SESSION['Auth']->id)
                ->where("confirm = 1")
                ->execute("User")
        );

        $projectEmpty = $this->project;
        $view->assign("projectEmpty", $projectEmpty);

        $view->assign("metaData", $metaData = [
            "title" => 'projects',
            "description" => 'Your projects',
            "src" => [
                ["type" => "js", "path" => "../js/ajax/project.js"],
                ["type" => "js", "path" => "../js/searchSelect.js"],
            ],
        ]);
    }


    public function composeProject()
    {
        $admin = $_SESSION['Auth']->rank;

        if (!empty($_POST) && $admin === "admin") {
            $users = explode(",", $_POST['users']);

                if($this->project->checkUserExist($this->user, $users) !== false) {

                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $projectId = isset($_POST['id']) ? $_POST['id'] : null;
                    $userId = $_SESSION['Auth']->id;

                    if (isset($title) && !empty($title)) {
                        $this->project->setTitle($title);
                    }

                    if (isset($description) && !empty($description)) {
                        $this->project->setDescription($description);
                    }

                    if (isset($projectId) && !empty($projectId)) {
                        $this->project->setId($projectId);
                        $this->user_project->setProjectKey($projectId);
                    }

                    $this->project->setUserKey($userId);
                    $this->project->save();
                    $this->user_project->addUsersToProject($users, $this->project->getLastId());

                    $view = new View("project-list");
                    $user = new User();
                    $user = $user->find($_SESSION['Auth']->id);
                    $view->assign("projects", $user->projects());

                    $view->assign(
                        "usersProject",
                        Query::from('cmspf_Users')
                            ->where("deleted IS NULL")
                            ->where("id != " . $_SESSION['Auth']->id)
                            ->where("confirm = 1")
                            ->execute("User")
                    );

                    $projectEmpty = $this->project;
                    $view->assign("projectEmpty", $projectEmpty);

                }else{
                    http_response_code(500);
                }

        } else {
            http_response_code(400);
        }
    }

    public function deleteProject()
    {
        $admin = $_SESSION['Auth']->rank;
        $id = $_POST['id'];

        if (!empty($id) && $admin === "admin") {
            $this->project->setId($id);
            $this->project->delete($id);
        }
    }

    public function listSteps($request)
    {
        if(isset($request['id']) && !empty($request['id'])) {

            $project = new Projet();
            $project = $project->find($request['id']);

            if($project) {
                $view = new View("step-list", "back");
                $this->step->setProjectKey($request['id']);
                $view->assign("step", $this->step);

                $view->assign("project", $project);

                $view->assign("metaData", $metaData = [
                    "title" => 'steps',
                    "description" => 'Your steps',
                    "src" => [
                        ["type" => "js", "path" => "../js/ajax/step.js"],
                    ],
                ]);
            }else{
                http_response_code(500);
            }

        }else{
            http_response_code(500);
        }
    }

    public function composeStep()
    {
        $admin = $_SESSION['Auth']->rank;

        if ($admin === "admin") {

            if (isset($_POST['project'])){

                $project = new Projet();
                $project = $project->find($_POST['project']);

                if($project) {
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $projectId = isset($_POST['project']) ? $_POST['project'] : null;
                    $idStep = isset($_POST['id']) ? $_POST['id'] : null;
                    $userId = $_SESSION['Auth']->id;


                    if (isset($title) && !empty($title)) {
                        $this->step->setTitle($title);
                    }

                    if (isset($description) && !empty($description)) {
                        $this->step->setDescription($description);
                    }

                    if (isset($idStep) && !empty($idStep)) {
                        $this->step->setId($idStep);
                    }

                    $this->step->setDate(date("Y-m-d H:i:s"));
                    $this->step->setProjectKey($projectId);
                    $this->step->setUserKey($userId);
                    $this->step->save();

                    $view = new View("step-list");
                    $this->step->setProjectKey($_POST['project']);
                    $view->assign("step", $this->step);

                    $view->assign("project", $project);
                }else{
                    http_response_code(500);
                }

            }else{
                http_response_code(500);
            }
        } else {
            http_response_code(300);
        }
    }

    public function deleteStep()
    {
        $admin = $_SESSION['Auth']->rank;
        $id = $_POST['id'];

        if (!empty($id) && $admin === "admin") {
            $this->step->setId($id);
            $this->step->delete($id);
        }
    }
}