<?php

namespace PhpLab\Sandbox\Queue\Domain\Services;

use PhpLab\Domain\Services\BaseCrudService;
use PhpLab\Sandbox\Queue\Domain\Repositories\Eloquent\JobRepository;

class JobService extends BaseCrudService
{

    public function __construct(JobRepository $repository)
    {
        $this->repository = $repository;
    }

}
