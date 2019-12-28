<?php

namespace PhpLab\Sandbox\Notify\Domain\Services;

use PhpLab\Sandbox\Notify\Domain\Entities\EmailEntity;
use PhpLab\Sandbox\Notify\Domain\Enums\PriorityEnum;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Services\EmailServiceInterface;

class EmailService implements EmailServiceInterface
{

    public function push(EmailEntity $emailEntity, $priority = PriorityEnum::NORMAL) {

    }

}
