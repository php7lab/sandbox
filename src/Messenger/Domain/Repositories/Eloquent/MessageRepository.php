<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Messenger\Domain\Entities\MessageEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\MessageRepositoryInterface;

class MessageRepository extends BaseEloquentCrudRepository implements MessageRepositoryInterface
{

    protected $tableName = 'messenger_message';

    public function getEntityClass(): string
    {
        return MessageEntity::class;
    }
}