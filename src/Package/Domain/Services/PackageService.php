<?php

namespace PhpLab\Sandbox\Package\Domain\Services;

use php7rails\domain\data\Query;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\PackageServiceInterface;
use PhpLab\Sandbox\Package\Domain\Interfaces\Repositories\PackageRepositoryInterface;
use PhpLab\Domain\Services\BaseCrudService;

class PackageService extends BaseCrudService implements PackageServiceInterface {

    public function __construct(PackageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allChanged(Query $query = null) {
        $query = Query::forge($query);
        return $this->repository->allChanged($query);
    }

}
