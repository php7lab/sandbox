<?php

namespace PhpLab\Sandbox\Article\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Article\Domain\Entities\PostTagEntity;
use PhpLab\Sandbox\Article\Domain\Interfaces\TagPostRepositoryInterface;

class TagPostRepository extends BaseEloquentCrudRepository implements TagPostRepositoryInterface
{

    protected $tableName = 'article_tag_post';
    protected $entityClass = PostTagEntity::class;

}