<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use php7rails\domain\data\Query;
use php7rails\domain\enums\RelationEnum;
use PhpLab\Domain\Data\Collection;
use PhpLab\Domain\Libs\Relation\OneToMany;
use PhpLab\Domain\Libs\Relation\OneToOne;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Sandbox\Messenger\Domain\Entities\ChatEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\MessageEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\MessageFlowEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Domain\Libs\Relation\ManyToMany;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\MessageFlowRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\MessageRepositoryInterface;

class MessageFlowRepository extends BaseEloquentCrudRepository implements MessageFlowRepositoryInterface
{

    protected $tableName = 'messenger_message_flow';
    protected $entityClass = MessageFlowEntity::class;

    private $messageRepository;

    public function __construct(Manager $capsule, MessageRepositoryInterface $messageRepository)
    {
        parent::__construct($capsule);
        $this->messageRepository = $messageRepository;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $query->with('message');
        return $query;
    }

    public function relations()
    {
        return [
            'message' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function(Collection $collection) {
                    $m2m = new OneToOne;
                    //$m2m->selfModel = $this;
                    $m2m->foreignModel = $this->messageRepository;
                    $m2m->foreignField = 'contentId';
                    $m2m->foreignContainerField = 'message';
                    $m2m->run($collection);
                },
            ],
        ];
    }

}