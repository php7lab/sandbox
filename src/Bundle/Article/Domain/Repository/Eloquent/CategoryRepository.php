<?php

namespace PhpLab\Sandbox\Bundle\Article\Domain\Repository\Eloquent;

use PhpLab\Sandbox\Bundle\Article\Domain\Entity\CategoryEntity;
use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repository\BaseEloquentCrudRepository;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    protected $tableName = 'article_category';
    protected $entityClass = CategoryEntity::class;

}