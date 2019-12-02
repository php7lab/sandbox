<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use php7rails\domain\enums\RelationEnum;
use PhpLab\Domain\Data\Collection;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Sandbox\Messenger\Domain\Entities\ChatEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Domain\Libs\Relation\OneToMany;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\FlowRepositoryInterface;

class ChatRepository extends BaseEloquentCrudRepository implements ChatRepositoryInterface
{

    protected $tableName = 'messenger_chat';
    protected $entityClass = ChatEntity::class;

    private $messageFlowRepository;

    public function __construct(Manager $capsule, FlowRepositoryInterface $messageFlowRepository)
    {
        parent::__construct($capsule);
        $this->messageFlowRepository = $messageFlowRepository;
    }

    public function relations()
    {
        return [
            'messages' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function(Collection $collection) {
                    $m2m = new OneToMany;
                    $m2m->selfModel = $this;
                    $m2m->foreignModel = $this->messageFlowRepository;
                    $m2m->selfField = 'chatId';
                    $m2m->foreignContainerField = 'messages';
                    $m2m->run($collection);
                },
            ],
        ];
    }

}