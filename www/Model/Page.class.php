<?php

namespace App\Model;

use App\Controller\Statistics;
use App\Core\BaseSQL;
use App\Core\Query;
use App\Model\Categorie;
use App\Model\Reseaux_soc;

class Page extends BaseSQL
{
    public $id = null;
    protected $date_update;
    protected $description;
    protected $title;
    protected $status;
    protected $slug;
    protected $user_key;
    protected $categorie_key;
    protected $content;

    /**
     * @return mixed
     */
    public function getCategorieKey()
    {
        return $this->categorie_key;
    }

    /**
     * @param mixed $categorie_key
     */
    public function setCategorieKey($categorie_key): void
    {
        $this->categorie_key = $categorie_key;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }


    /**
     * Page constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function composeStats(int $elementId, string $type)
    {
        $stat = new Statistics();
        $stat->composeStats($elementId, $type);
    }

    public function save()
    {
        parent::save();
    }

    public function find($id = null, string $attribut = 'id')
    {
        return parent::find($id, $attribut);
    }

    public function categories()
    {
        return parent::belongsToMany(Categorie::class, 'cmspf_Page_categorie');
    }

    public function categorie()
    {
        $categories = parent::belongsToMany(Categorie::class, 'cmspf_Page_categorie');
        foreach ($categories as $categorie){
            if ($categorie->getType() == 'Tag'){
                return $categorie;
            }
        }
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
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }


    /**
     * @return null
     */
    public function getId(): ? int
    {
        return $this->id;
    }

    public function setId($id): object
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->date_update;
    }

    /**
     * @param mixed $dateUpdate
     */
    public function setDateUpdate($dateUpdate): void
    {
        $this->date_update = $dateUpdate;
    }

    /**
     * @return mixed
     */
    public function getDescription(): ? string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTitle(): ? string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getStatus(): ? string
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    public function header()
    {
        $header = new Categorie();
        $header = $header->find(1);
        $categories = $header->categories();
        $pages = $header->pages();

        $backgroundColor = $header->getBackgroundColor();
        if ($backgroundColor != null || $backgroundColor != 'unset') {
            if ($backgroundColor == 'main-color') {
                $backgroundColor = 'background-main-color';
            }elseif ($backgroundColor == 'second-color') {
                $backgroundColor = 'background-second-color';
            }elseif ($backgroundColor == 'third-color') {
                $backgroundColor = 'background-third-color';
            }else{
                $backgroundColor = $backgroundColor;
            }
        }else{
            $backgroundColor = null;
        }

        $btnTextColor = $header->getBtnTextColor();
        if ($btnTextColor != null || $btnTextColor != 'unset') {
            if ($btnTextColor == 'main-color') {
                $btnTextColor = 'color-main-color';
            }elseif ($btnTextColor == 'second-color') {
                $btnTextColor = 'color-second-color';
            }elseif ($btnTextColor == 'third-color') {
                $btnTextColor = 'color-third-color';
            }else{
                $btnTextColor = $btnTextColor;
            }
        }else{
            $btnTextColor = null;
        }

        $radius = Query::from('cmspf_Options')
            ->where("type = 'radius'")
            ->execute('Option');

        $logo = Query::from('cmspf_Options')
            ->where("type = 'logo'")
            ->execute('Option');

        include "View/Partial/header.partial.php";
    }

    public function footer()
    {
        $footer = new Categorie();
        $footer = $footer->find(2);
        $categories = $footer->categories();
        $pages = $footer->pages();

        $backgroundColor = $footer->getBackgroundColor();
        if ($backgroundColor != null || $backgroundColor != 'unset') {
            if ($backgroundColor == 'main-color') {
                $backgroundColor = 'background-main-color';
            }elseif ($backgroundColor == 'second-color') {
                $backgroundColor = 'background-second-color';
            }elseif ($backgroundColor == 'third-color') {
                $backgroundColor = 'background-third-color';
            }else{
                $backgroundColor = $backgroundColor;
            }
        }else{
            $backgroundColor = null;
        }

        $btnTextColor = $footer->getBtnTextColor();
        if ($btnTextColor != null || $btnTextColor != 'unset') {
            if ($btnTextColor == 'main-color') {
                $btnTextColor = 'color-main-color';
            }elseif ($btnTextColor == 'second-color') {
                $btnTextColor = 'color-second-color';
            }elseif ($btnTextColor == 'third-color') {
                $btnTextColor = 'color-third-color';
            }else{
                $btnTextColor = $btnTextColor;
            }
        }else{
            $btnTextColor = null;
        }

        $radius = Query::from('cmspf_Options')
            ->where("type = 'radius'")
            ->execute('Option');

        $reseauxSoc = new Reseaux_soc();
        $reseauxSocs = $reseauxSoc->find();

        include "View/Partial/footer.partial.php";
    }

    public function getFormNewPage($categories): array
    {
        foreach($categories as $categorie){
            $categoriesList['choices'][] = [
                "value" => $categorie->getId(),
                "label" => $categorie->getTitle(),
                "class"=>"input"
            ];
        }


        return [
            "config"=>[
                "method"=>"POST",
                "submit"=>"Save",
                "cta"=>"cta-button-compose-page"
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "name"=>"id",
                    "class"=>"input",
                    "value"=>$this->getId(),
                    "error"=>""
                ],
                "title"=>[
                    "question"=>"Title",
                    "type"=>"text",
                    "placeholder"=>"Page title",
                    "name"=>"title",
                    "class"=>"input",
                    "required"=>true,
                    "min"=>3,
                    "max"=>30,
                    "value"=>$this->getTitle(),
                    "error"=>""
                ],
                "status"=>[
                    "question"=>"Visibility",
                    "type"=>"select",
                    "name"=>"status",
                    "class"=>"input",
                    "required"=>true,
                    "min"=>3,
                    "max"=>16,
                    "error"=>"",
                    "value"=>$this->getStatus(),
                    "choices"=>[
                        [
                            "value" => "Public",
                            "label" => "Public",
                            "class"=>"input"
                        ],
                        [
                            "value" => "Draft",
                            "label" => "Draft",
                            "class"=>"input"
                        ],
                    ]
                ],
                "slug"=>[
                    "question"=>"Slug",
                    "type"=>"text",
                    "name"=>"slug",
                    "placeholder"=>"Page slug",
                    "class"=>"input",
                    "required"=>true,
                    "min"=>0,
                    "max"=>16,
                    "value"=>$this->getSlug(),
                    "unicity"=>true,
                    "error"=>""
                ],
                "categorie"=>[
                    "question"=>"Categorie",
                    "type"=>"select",
                    "name"=>"categorie",
                    "class"=>"input",
                    "error"=>"",
                    "idToVerif"=>true,
                    "value"=>($this->categorie() != null )? $this->categorie()->getId() :'',
                    "choices"=>$categoriesList['choices']
                ],
                "description"=>[
                    "question"=>"Description",
                    "type"=>"textarea",
                    "placeholder"=>"Page description",
                    "name"=>"description",
                    "class"=>"input",
                    "required"=>true,
                    "rows"=>4,
                    "min"=>3,
                    "max"=>100,
                    "value"=>$this->getDescription(),
                    "error"=>""
                ]
            ]

        ];
    }
}