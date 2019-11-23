<?php

namespace PhpLab\Sandbox\Bundle\Messenger\Domain\Repository\Eloquent;

use PhpLab\Sandbox\Bundle\Messenger\Domain\Entity\ChatEntity;
use PhpLab\Sandbox\Bundle\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repository\BaseEloquentCrudRepository;

class ChatRepository extends BaseEloquentCrudRepository implements ChatRepositoryInterface
{

    protected $tableName = 'messenger_chat';
    protected $entityClass = ChatEntity::class;

}