<?php

namespace PhpLab\Sandbox\Package\Domain\Interfaces\Repositories;

use php7rails\domain\data\Query;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Interfaces\ReadAllServiceInterface;
use PhpLab\Domain\Interfaces\ReadOneServiceInterface;
use PhpLab\Domain\Interfaces\RelationConfigInterface;
use PhpLab\Domain\Interfaces\RepositoryInterface;

interface PackageRepositoryInterface extends RepositoryInterface, GetEntityClassInterface, ReadAllServiceInterface, ReadOneServiceInterface, RelationConfigInterface
{

    public function allChanged(Query $query = null);

}
