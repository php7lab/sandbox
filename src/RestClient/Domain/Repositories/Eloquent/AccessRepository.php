<?php

namespace PhpLab\Sandbox\RestClient\Domain\Repositories\Eloquent;

use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\AccessRepositoryInterface;

class AccessRepository extends BaseEloquentCrudRepository implements AccessRepositoryInterface
{

    protected $tableName = 'restclient_access';

    protected $entityClass = 'PhpLab\\Sandbox\\RestClient\\Domain\\Entities\\AccessEntity';

    public function oneByTie(int $projectId, int $userId) {
        $query = new Query;
        $query->where('project_id', $projectId);
        $query->where('user_id', $userId);
        return $this->one($query);
    }

    public function allByUserId(int $userId) {
        $query = new Query;
        $query->where('user_id', $userId);
        return $this->all($query);
    }

}

