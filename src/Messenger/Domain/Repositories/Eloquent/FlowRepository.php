<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Data\Query;
use PhpLab\Core\Domain\Enums\RelationEnum;
use PhpLab\Core\Domain\Libs\Relation\OneToOne;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Messenger\Domain\Entities\FlowEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\FlowRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\MessageRepositoryInterface;

class FlowRepository extends BaseEloquentCrudRepository implements FlowRepositoryInterface
{

    protected $tableName = 'messenger_flow';
    protected $entityClass = FlowEntity::class;

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
                'callback' => function (Collection $collection) {
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