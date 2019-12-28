<?php

namespace PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories;

use PhpLab\Sandbox\Notify\Domain\Entities\SmsEntity;

interface SmsRepositoryInterface
{

    public function send(SmsEntity $smsEntity);

}