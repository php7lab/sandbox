<?php

namespace PhpLab\Sandbox\Storage\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Storage\Domain\Interfaces\Repositories\ServiceRepositoryInterface;

class ServiceRepository extends BaseEloquentCrudRepository implements ServiceRepositoryInterface
{

    protected $tableName = 'storage_service';

    protected $entityClass = 'PhpLab\\Sandbox\\Storage\\Domain\\Entities\\ServiceEntity';


}

