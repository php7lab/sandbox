<?php

namespace PhpLab\Sandbox\Queue\Domain\Services;

use PhpLab\Domain\Exceptions\DisabledMethodException;
use PhpLab\Domain\Services\BaseCrudService;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobServiceInterface;

class JobService extends BaseCrudService implements JobServiceInterface
{

    public function __construct(JobRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function push(JobEntity $jobEntity)
    {

    }

    public function runAll() {

    }

}
