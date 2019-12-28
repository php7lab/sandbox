<?php

namespace PhpLab\Sandbox\Notify\Domain\Jobs;

use PhpLab\Sandbox\Notify\Domain\Entities\EmailEntity;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobInterface;

class SendEmailJob implements JobInterface
{

    /** @var EmailEntity */
    public $entity;
    private $emailRepository;

    public function __construct(EmailRepositoryInterface $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    public function run() {
        $this->emailRepository->send($this->entity);
    }

}