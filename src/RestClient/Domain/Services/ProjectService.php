<?php

namespace PhpLab\Sandbox\RestClient\Domain\Services;

use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;

class ProjectService extends BaseCrudService implements ProjectServiceInterface
{

    public function __construct(\PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\ProjectRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

