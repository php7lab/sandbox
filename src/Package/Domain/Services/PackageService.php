<?php

namespace PhpLab\Sandbox\Package\Domain\Services;

use Illuminate\Support\Collection;
use php7rails\domain\data\Query;
use php7tool\vendor\domain\helpers\GitShell;
use PhpLab\Domain\Services\BaseCrudService;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Repositories\PackageRepositoryInterface;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\PackageServiceInterface;

class PackageService extends BaseCrudService implements PackageServiceInterface
{

    public function __construct(PackageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allChanged(Query $query = null): Collection
    {
        $query = Query::forge($query);
        return $this->repository->allChanged($query);
    }

    public function pullPackage(PackageEntity $packageEntity)
    {
        $git = new GitShell($packageEntity->getDirectory());
        $git->pull();
    }

}
