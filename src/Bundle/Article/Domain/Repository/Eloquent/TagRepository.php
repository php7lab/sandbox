<?php

namespace PhpLab\Sandbox\Bundle\Article\Domain\Repository\Eloquent;

use PhpLab\Sandbox\Bundle\Article\Domain\Entity\TagEntity;
use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpLab\Eloquent\Db\Repository\BaseEloquentCrudRepository;

class TagRepository extends BaseEloquentCrudRepository implements TagRepositoryInterface
{

    protected $tableName = 'article_tag';
    protected $entityClass = TagEntity::class;

}