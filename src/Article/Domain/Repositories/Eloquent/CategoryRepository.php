<?php

namespace PhpLab\Sandbox\Article\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Article\Domain\Entities\CategoryEntity;
use PhpLab\Sandbox\Article\Domain\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    protected $tableName = 'article_category';

    public function getEntityClass(): string
    {
        return CategoryEntity::class;
    }

}