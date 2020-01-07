<?php

namespace PhpLab\Sandbox\Queue\Domain\Interfaces;

use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;

interface JobServiceInterface
{

    public function push(JobInterface $job, int $priority = PriorityEnum::NORMAL);

    public function runAll(string $channel = null): int;

}