<?php

namespace PhpLab\Sandbox\Article\Domain\Repository\Eloquent;

use PhpLab\Sandbox\Article\Domain\Entity\CategoryEntity;
use PhpLab\Sandbox\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repository\BaseEloquentCrudRepository;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    protected $tableName = 'article_category';
    protected $entityClass = CategoryEntity::class;

}