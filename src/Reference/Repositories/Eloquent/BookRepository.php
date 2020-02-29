<?php

namespace PhpLab\Sandbox\Reference\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Reference\Interfaces\Repositories\BookRepositoryInterface;

class BookRepository extends BaseEloquentCrudRepository implements BookRepositoryInterface
{

    protected $tableName = 'reference_book';

    protected $entityClass = 'PhpLab\\Sandbox\\Reference\\Entities\\BookEntity';


}

