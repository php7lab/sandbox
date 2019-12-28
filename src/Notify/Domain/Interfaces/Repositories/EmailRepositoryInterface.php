<?php

namespace PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories;

use PhpLab\Sandbox\Notify\Domain\Entities\EmailEntity;

interface EmailRepositoryInterface
{

    public function send(EmailEntity $emailEntity);

}