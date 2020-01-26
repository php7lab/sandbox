<?php

namespace PhpLab\Sandbox\Storage\Domain\Services;

use PhpLab\Domain\Base\BaseCrudService;
use PhpLab\Sandbox\Storage\Domain\Interfaces\Services\ServiceServiceInterface;

class ServiceService extends BaseCrudService implements ServiceServiceInterface
{

    public function __construct(\PhpLab\Sandbox\Storage\Domain\Interfaces\Repositories\ServiceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

