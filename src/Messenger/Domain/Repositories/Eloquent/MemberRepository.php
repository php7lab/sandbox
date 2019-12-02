<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Messenger\Domain\Entities\MemberEntity;

class MemberRepository extends BaseEloquentCrudRepository /*implements ChatRepositoryInterface*/
{

    protected $tableName = 'messenger_member';
    protected $entityClass = MemberEntity::class;

}