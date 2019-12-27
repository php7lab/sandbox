<?php

namespace PhpLab\Sandbox\Notify\Domain\Interfaces;

use PhpLab\Sandbox\Notify\Domain\Entities\SmsEntity;

interface SmsInterface
{

    public function push(SmsEntity $smsEntity);

}