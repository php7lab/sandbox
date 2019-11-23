<?php

namespace PhpLab\Sandbox\Bundle\Article\Domain\Repository\Eloquent;

use PhpLab\Sandbox\Bundle\Article\Domain\Entity\PostTagEntity;
use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use PhpLab\Eloquent\Db\Repository\BaseEloquentCrudRepository;

class TagPostRepository extends BaseEloquentCrudRepository implements TagPostRepositoryInterface
{

    protected $tableName = 'article_tag_post';
    protected $entityClass = PostTagEntity::class;

}