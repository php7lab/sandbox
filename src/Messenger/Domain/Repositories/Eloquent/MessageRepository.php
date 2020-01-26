<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use PhpLab\Domain\Enums\RelationEnum;
use Illuminate\Support\Collection;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Sandbox\Messenger\Domain\Entities\ChatEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\MessageEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Domain\Libs\Relation\ManyToMany;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\MessageRepositoryInterface;

class MessageRepository extends BaseEloquentCrudRepository implements MessageRepositoryInterface
{

    protected $tableName = 'messenger_message';
    protected $entityClass = MessageEntity::class;

}