<?php
namespace App\Model;

use App\Controller\Statistics;
use App\Core\BaseSQL;
use App\Core\Query;

class Reseaux_soc extends BaseSQL
{

    protected $id = null;
    protected $type;
    protected $path;
    protected $user_key;
    protected $table_name = 'cmspf_Reseaux_soc';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getUserKey()
    {
        return $this->user_key;
    }

    /**
     * @param mixed $user_key
     */
    public function setUserKey($user_key): void
    {
        $this->user_key = $user_key;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->table_name;
    }

    /**
     * @param string $table_name
     */
    public function setTableName(string $table_name): void
    {
        $this->table_name = $table_name;
    }

    public function save()
    {
        parent::save();
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

    public function composeStats(int $elementId, string $type)
    {
        $stat = new Statistics();
        $stat->composeStats($elementId, $type);
    }
    public function getStats()
    {

        return Query::select("COUNT(reseau_soc_key) AS number")->from("cmspf_Stats")->where(" reseau_soc_key = ".$this->getId())->execute()[0]['number'];
    
    }

    public function getFormNewReseauxSoc(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "submit"=>"Save",
                "cta"=>"cta-button-compose-reseaux-soc"
            ],
            "inputs"=>[
                "type"=>[
                    "question"=>"Social media",
                    "type"=>"select",
                    "name"=>"type",
                    "class"=>"input",
                    "required"=>true,
                    "error"=>"",
                    "value"=>$this->getType(),
                    "choices"=>[
                        [
                            "value" => "instagram",
                            "label" => "Instagram",
                            "class"=>"input"
                        ],
                        [
                            "value" => "twitter",
                            "label" => "Twitter",
                            "class"=>"input"
                        ],
                        [
                            "value" => "linkedin",
                            "label" => "Linkedin",
                            "class"=>"input"
                        ],
                        [
                            "value" => "youtube",
                            "label" => "Youtube",
                            "class"=>"input"
                        ],
                        [
                            "value" => "tik_tok",
                            "label" => "Tik tok",
                            "class"=>"input"
                        ]
                    ]
                ],
                "link"=>[
                    "question"=>"Link",
                    "type"=>"text",
                    "placeholder"=>"Link",
                    "name"=>"link",
                    "class"=>"input",
                    "required"=>true,
                    "min"=>3,
                    "max"=>250,
                    "value"=>$this->getPath(),
                    "error"=>""
                ],
            ]

        ];
    }
}

