<?php

namespace PhpLab\Sandbox\Package\Domain\Services;

use PhpLab\Domain\Services\BaseCrudService;
use PhpLab\Sandbox\Package\Domain\Interfaces\Repositories\PackageRepositoryInterface;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\PackageServiceInterface;

class PackageService extends BaseCrudService implements PackageServiceInterface
{

    public function __construct(PackageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

}
