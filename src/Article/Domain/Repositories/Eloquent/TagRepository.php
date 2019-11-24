<?php

namespace PhpLab\Sandbox\Article\Domain\Repositories\Eloquent;

use PhpLab\Sandbox\Article\Domain\Entities\TagEntity;
use PhpLab\Sandbox\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;

class TagRepository extends BaseEloquentCrudRepository implements TagRepositoryInterface
{

    protected $tableName = 'article_tag';
    protected $entityClass = TagEntity::class;

}