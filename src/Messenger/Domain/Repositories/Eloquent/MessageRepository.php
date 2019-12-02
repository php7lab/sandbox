<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use php7rails\domain\enums\RelationEnum;
use PhpLab\Domain\Data\Collection;
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

    protected $tableName = 'messenger_content';
    protected $entityClass = MessageEntity::class;

}