<?php

namespace PhpLab\Sandbox\Notify\Domain\Jobs;

use PhpLab\Sandbox\Notify\Domain\Entities\EmailEntity;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobInterface;

class SendEmailJob implements JobInterface
{

    /** @var EmailEntity */
    public $entity;
    private $emailService;

    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function run() {
        $this->emailService->send($this->entity);
    }

}