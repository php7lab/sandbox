<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Enums\RelationEnum;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Core\Domain\Libs\Relation\OneToMany;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Messenger\Domain\Entities\BotEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\ChatEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\FlowRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\MemberRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Repositories\BotRepositoryInterface;
use Symfony\Component\Security\Core\Security;

class BotRepository extends BaseEloquentCrudRepository implements BotRepositoryInterface
{

    protected $tableName = 'messenger_bot';

    public function getEntityClass(): string
    {
        return BotEntity::class;
    }
}