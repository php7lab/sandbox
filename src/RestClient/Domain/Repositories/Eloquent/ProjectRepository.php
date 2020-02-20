<?php

namespace PhpLab\Sandbox\RestClient\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\ProjectRepositoryInterface;

class ProjectRepository extends BaseEloquentCrudRepository implements ProjectRepositoryInterface
{

    protected $tableName = 'restClient_project';

    protected $entityClass = 'PhpLab\\Sandbox\\RestClient\\Domain\\Entities\\ProjectEntity';


}

