<?php

namespace PhpLab\Sandbox\Bundle\Article\Domain\Repository\Eloquent;

use Doctrine\Common\Inflector\Inflector;
use php7rails\domain\data\Query;
use PhpLab\Sandbox\Bundle\Article\Domain\Entity\PostEntity;
use PhpLab\Sandbox\Bundle\Article\Domain\Entity\PostTagEntity;
use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\PostRepositoryInterface;
use php7rails\domain\enums\RelationEnum;
use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpLab\Domain\Data\Collection;
use PhpLab\Domain\Helper\EntityHelper;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Libs\Relation\ManyToMany;
use PhpLab\Domain\Libs\Relation\OneToOne;
use PhpLab\Eloquent\Db\Repository\BaseEloquentCrudRepository;
use Symfony\Component\PropertyAccess\PropertyAccess;
use PhpLab\Eloquent\Db\Helper\Manager;

class PostRepository extends BaseEloquentCrudRepository implements PostRepositoryInterface
{

    protected $tableName = 'article_post';
    protected $entityClass = PostEntity::class;
    private $categoryRepository;
    private $tagPostRepository;
    private $tagRepository;

    public function __construct(Manager $capsule, CategoryRepositoryInterface $categoryRepository, TagRepositoryInterface $tagRepository, TagPostRepositoryInterface $tagPostRepository)
    {
        parent::__construct($capsule);
        $this->categoryRepository = $categoryRepository;
        $this->tagPostRepository = $tagPostRepository;
        $this->tagRepository = $tagRepository;
    }

    public function relations()
    {
        return [
            'category' => [
                /*'type' => RelationEnum::ONE,
                'field' => 'categoryId',
                'foreign' => [
                    'model' => $this->categoryRepository,
                    'field' => 'id',
                ],*/
                'type' => RelationEnum::CALLBACK,
                'callback' => function(Collection $collection) {
                    $m2m = new OneToOne;
                    //$m2m->selfModel = $this;

                    $m2m->foreignModel = $this->categoryRepository;
                    $m2m->foreignField = 'categoryId';
                    $m2m->foreignContainerField = 'category';

                    $m2m->run($collection);
                },
            ],
            'tags' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function(Collection $collection) {
                    $m2m = new ManyToMany;
                    $m2m->selfModel = $this;
                    $m2m->selfField = 'postId';

                    $m2m->viaModel = $this->tagPostRepository;

                    $m2m->foreignModel = $this->tagRepository;
                    $m2m->foreignField = 'tagId';
                    $m2m->foreignContainerField = 'tags';

                    $m2m->run($collection);
                },
            ],
        ];
    }

}