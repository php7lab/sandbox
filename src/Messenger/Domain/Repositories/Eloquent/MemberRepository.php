<?php

namespace PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent;

use php7rails\domain\data\Query;
use php7rails\domain\enums\RelationEnum;
use PhpLab\Domain\Data\Collection;
use PhpLab\Domain\Libs\Relation\OneToOne;
use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Messenger\Domain\Entities\MemberEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\MemberRepositoryInterface;
use PhpLab\Sandbox\User\Domain\Interfaces\UserRepositoryInterface;
use PhpLab\Eloquent\Db\Helpers\Manager;

class MemberRepository extends BaseEloquentCrudRepository implements MemberRepositoryInterface
{

    protected $tableName = 'messenger_member';
    protected $entityClass = MemberEntity::class;

    private $userRepository;

    public function __construct(Manager $capsule, UserRepositoryInterface $userRepository)
    {
        parent::__construct($capsule);
        $this->userRepository = $userRepository;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $query->with('user');
        return $query;
    }

    public function relations()
    {
        return [
            'user' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function(Collection $collection) {
                    $m2m = new OneToOne;
                    $m2m->foreignModel = $this->userRepository;
                    $m2m->foreignField = 'userId';
                    $m2m->foreignContainerField = 'user';
                    $m2m->run($collection);
                },
            ],
        ];
    }

}