<?php

namespace PhpLab\Sandbox\RestClient\Domain\Repositories\Eloquent;

use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\ProjectRepositoryInterface;

class ProjectRepository extends BaseEloquentCrudRepository implements ProjectRepositoryInterface
{

    protected $tableName = 'restClient_project';

    protected $entityClass = 'PhpLab\\Sandbox\\RestClient\\Domain\\Entities\\ProjectEntity';

    public function oneByName(string $projectName) {
        $query = new Query;
        $query->where('name', $projectName);
        return $this->one($query);
    }
}

