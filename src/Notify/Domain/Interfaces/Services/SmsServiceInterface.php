<?php

namespace PhpLab\Sandbox\Notify\Domain\Interfaces\Services;

use PhpLab\Sandbox\Notify\Domain\Entities\SmsEntity;
use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;

interface SmsServiceInterface
{

    public function push(SmsEntity $smsEntity, $priority = PriorityEnum::NORMAL);

}