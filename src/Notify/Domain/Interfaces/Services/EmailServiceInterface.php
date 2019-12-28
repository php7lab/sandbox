<?php

namespace PhpLab\Sandbox\Notify\Domain\Interfaces\Services;

use PhpLab\Sandbox\Notify\Domain\Entities\EmailEntity;
use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;

interface EmailServiceInterface
{

    public function push(EmailEntity $emailEntity, $priority = PriorityEnum::NORMAL);
    public function send(EmailEntity $emailEntity);

}