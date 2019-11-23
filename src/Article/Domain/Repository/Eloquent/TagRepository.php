<?php

namespace PhpLab\Sandbox\Article\Domain\Repository\Eloquent;

use PhpLab\Sandbox\Article\Domain\Entity\TagEntity;
use PhpLab\Sandbox\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpLab\Eloquent\Db\Repository\BaseEloquentCrudRepository;

class TagRepository extends BaseEloquentCrudRepository implements TagRepositoryInterface
{

    protected $tableName = 'article_tag';
    protected $entityClass = TagEntity::class;

}