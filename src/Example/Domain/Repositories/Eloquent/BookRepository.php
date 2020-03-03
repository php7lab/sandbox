<?php

namespace PhpLab\Sandbox\Example\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Example\Domain\Entities\BookEntity;
use PhpLab\Sandbox\Example\Domain\Interfaces\Repositories\BookRepositoryInterface;

class BookRepository extends BaseEloquentCrudRepository implements BookRepositoryInterface
{

    protected $tableName = 'example_book';
    protected $entityClass = BookEntity::class;

}
