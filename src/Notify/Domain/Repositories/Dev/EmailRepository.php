<?php

namespace PhpLab\Sandbox\Notify\Domain\Repositories\Dev;

use PhpLab\Sandbox\Notify\Domain\Entities\EmailEntity;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;

class EmailRepository extends BaseRepository implements EmailRepositoryInterface
{

    const DIRECTORY = __DIR__ . '/../../../../../../../../var/data/notify/email';

    public function send(EmailEntity $emailEntity)
    {
        $this->saveToFile($emailEntity);
    }

}
