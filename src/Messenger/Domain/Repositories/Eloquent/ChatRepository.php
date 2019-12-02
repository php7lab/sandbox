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
use PhpLab\Sandbox\Messenger\Domain\Interfaces\MemberRepositoryInterface;

class ChatRepository extends BaseEloquentCrudRepository implements ChatRepositoryInterface
{

    protected $tableName = 'messenger_chat';
    protected $entityClass = ChatEntity::class;

    private $flowRepository;
    private $memberRepository;

    public function __construct(Manager $capsule, FlowRepositoryInterface $flowRepository, MemberRepositoryInterface $memberRepository)
    {
        parent::__construct($capsule);
        $this->flowRepository = $flowRepository;
        $this->memberRepository = $memberRepository;
    }

    public function relations()
    {
        return [
            'messages' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function(Collection $collection) {
                    $m2m = new OneToMany;
                    $m2m->selfModel = $this;
                    $m2m->foreignModel = $this->flowRepository;
                    $m2m->selfField = 'chatId';
                    $m2m->foreignContainerField = 'messages';
                    $m2m->run($collection);
                },
            ],
            'members' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function(Collection $collection) {
                    $m2m = new OneToMany;
                    $m2m->selfModel = $this;
                    $m2m->foreignModel = $this->memberRepository;
                    $m2m->selfField = 'chatId';
                    $m2m->foreignContainerField = 'members';
                    $m2m->run($collection);
                },
            ],
        ];
    }

}