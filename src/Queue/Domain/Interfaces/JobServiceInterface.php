<?php

namespace PhpLab\Sandbox\Queue\Domain\Interfaces;

use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Interfaces\ReadAllServiceInterface;
use PhpLab\Domain\Interfaces\ReadOneServiceInterface;
use PhpLab\Domain\Interfaces\ServiceInterface;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;

interface JobServiceInterface extends ServiceInterface, GetEntityClassInterface, ReadAllServiceInterface, ReadOneServiceInterface
{

    public function push(JobEntity $jobEntity);
    public function runAll();

}