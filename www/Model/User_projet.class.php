<?php


namespace App\Model;

use App\Core\BaseSQL;
use App\Core\Query;
use App\Controller\Mail;


class User_projet extends BaseSQL
{
    protected $id = null;
    protected $user_key = null;
    protected $projet_key = null;
    protected $table_name = 'cmspf_User_projet';
    protected $type = "customer";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->table_name;
    }

    /**
     * Get the value of id
     */
    public function getId(): ? int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUserKey(): ? int
    {
        return $this->user_key;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): ? string
    {
        return $this->type;
    }

    public function setUserKey($id)
    {
        $this->user_key = $id;
        return $this;
    }

    public function getProjectKey(): ? int
    {
        return $this->projet_key;
    }

    public function setProjectKey($id)
    {
        $this->projet_key = $id;
        return $this;
    }

    public function save()
    {
        parent::save();
    }

    public function delete($id)
    {
        return parent::delete($id);

    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

    public function addUsersToProject(array $usersid, $projectId = null)
    {
        if($this->getProjectKey()) {
            $project_user = Query::from('cmspf_User_projet')
                ->where('projet_key = ' . $this->getProjectKey())
                ->where('user_key != ' . $_SESSION['Auth']->id)
                ->execute('User_projet');

            foreach ($project_user as $res) {
                $val = array_search($res->getUserKey(), $usersid);
                $id = $res->getId();

                if ($val === false) {
                    $this->setId($id);
                    $this->delete($id);
                    //unset($usersid[$val]);
                }

            }

            foreach ($usersid as $id) {
                $req = Query::from('cmspf_User_projet')
                    ->where('user_key = ' . $id)
                    ->where('projet_key = ' . $this->getProjectKey())
                    ->execute('User_projet');

                $user = Query::from('cmspf_Users')
                    ->where('id = :id')
                    ->params(["id" => $id])
                    ->execute('User')[0];

                $mail = new Mail();

                if(empty($req[0])){
                    $this->setUserKey($id);
                    $this->save();
                    $mail->confirmUserInProject($user->getMail(), $user->getLastname() . ' ' . $user->getFirstname(), $this->getProjectKey());
                }
            }
        }else{
            $this->setProjectKey($projectId);
            $this->setUserKey($_SESSION['Auth']->id);
            $this->save();
            $mail = new Mail();

            foreach ($usersid as $id) {
                $user = Query::from('cmspf_Users')
                    ->where('id = :id')
                    ->params(["id" => $id])
                    ->execute('User')[0];

                $this->setUserKey($id);
                $this->save();
                $mail->confirmUserInProject($user->getMail(), $user->getLastname() . ' ' . $user->getFirstname(), $this->getProjectKey());
            }
        }
    }


}