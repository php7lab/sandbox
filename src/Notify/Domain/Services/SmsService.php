<?php

namespace PhpLab\Sandbox\Notify\Domain\Services;

use PhpLab\Sandbox\Notify\Domain\Entities\SmsEntity;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Services\SmsServiceInterface;
use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;

class SmsService implements SmsServiceInterface
{

    public function push(SmsEntity $smsEntity, $priority = PriorityEnum::NORMAL)
    {

    }

}
