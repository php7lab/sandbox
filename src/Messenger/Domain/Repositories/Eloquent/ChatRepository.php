<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use PhpLab\Sandbox\Messenger\Domain\Entities\ChatEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;

class ChatRepository extends BaseEloquentCrudRepository implements ChatRepositoryInterface
{

    protected $tableName = 'messenger_chat';
    protected $entityClass = ChatEntity::class;

}