<?php

namespace PhpLab\Sandbox\Notify\Domain\Services;

use PhpLab\Sandbox\Notify\Domain\Entities\SmsEntity;
use PhpLab\Sandbox\Notify\Domain\Enums\PriorityEnum;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Services\SmsServiceInterface;

class SmsService implements SmsServiceInterface
{

    public function push(SmsEntity $smsEntity, $priority = PriorityEnum::NORMAL) {

    }

}
