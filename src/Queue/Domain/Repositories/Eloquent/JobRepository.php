<?php

namespace PhpLab\Sandbox\Queue\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobRepositoryInterface;

class JobRepository extends BaseEloquentCrudRepository implements JobRepositoryInterface
{

    protected $tableName = 'queue_job';
    protected $entityClass = JobEntity::class;

}
