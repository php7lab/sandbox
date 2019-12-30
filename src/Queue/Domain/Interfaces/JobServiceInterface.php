<?php

namespace PhpLab\Sandbox\Queue\Domain\Interfaces;

use php7rails\domain\data\Query;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Interfaces\ReadAllServiceInterface;
use PhpLab\Domain\Interfaces\ReadOneServiceInterface;
use PhpLab\Domain\Interfaces\ServiceInterface;
use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;

interface JobServiceInterface extends ServiceInterface, GetEntityClassInterface, ReadAllServiceInterface, ReadOneServiceInterface
{

    public function push(JobInterface $job, int $priority = PriorityEnum::NORMAL);
    public function runAll(string $channel = null, Query $query = null);

}