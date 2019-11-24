<?php

namespace PhpLab\Sandbox\Article\Domain\Repositories\Eloquent;

use PhpLab\Sandbox\Article\Domain\Entities\CategoryEntity;
use PhpLab\Sandbox\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    protected $tableName = 'article_category';
    protected $entityClass = CategoryEntity::class;

}