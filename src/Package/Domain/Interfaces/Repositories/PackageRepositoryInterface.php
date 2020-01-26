<?php

namespace PhpLab\Sandbox\Package\Domain\Interfaces\Repositories;

use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Interfaces\ReadAllInterface;
use PhpLab\Domain\Interfaces\Repository\ReadOneInterface;
use PhpLab\Domain\Interfaces\Repository\RelationConfigInterface;
use PhpLab\Domain\Interfaces\Repository\RepositoryInterface;

interface PackageRepositoryInterface extends RepositoryInterface, GetEntityClassInterface, ReadAllInterface, ReadOneInterface, RelationConfigInterface
{

}
