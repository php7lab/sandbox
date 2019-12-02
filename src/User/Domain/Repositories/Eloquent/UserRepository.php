<?php

namespace PhpLab\Sandbox\User\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Sandbox\User\Domain\Entities\Identity;
use PhpLab\Sandbox\User\Domain\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseEloquentCrudRepository implements UserRepositoryInterface
{

    protected $tableName = 'fos_user';
    protected $entityClass = Identity::class;

}