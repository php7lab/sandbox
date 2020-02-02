<?php

namespace PhpLab\Sandbox\Article\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Enums\RelationEnum;
use PhpLab\Core\Domain\Libs\Relation\ManyToMany;
use PhpLab\Core\Domain\Libs\Relation\OneToOne;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Article\Domain\Entities\PostEntity;
use PhpLab\Sandbox\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpLab\Sandbox\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpLab\Sandbox\Article\Domain\Interfaces\TagPostRepositoryInterface;
use PhpLab\Sandbox\Article\Domain\Interfaces\TagRepositoryInterface;

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
                'callback' => function (Collection $collection) {
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
                'callback' => function (Collection $collection) {
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