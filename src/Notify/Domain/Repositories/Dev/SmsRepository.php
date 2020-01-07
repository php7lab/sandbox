<?php

namespace PhpLab\Sandbox\Notify\Domain\Repositories\Dev;

use PhpLab\Sandbox\Notify\Domain\Entities\SmsEntity;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories\SmsRepositoryInterface;

class SmsRepository extends BaseRepository implements SmsRepositoryInterface
{

    const DIRECTORY = __DIR__ . '/../../../../../../../../var/data/notify/sms';

    public function send(SmsEntity $smsEntity)
    {
        $this->saveToFile($smsEntity);
    }

}
