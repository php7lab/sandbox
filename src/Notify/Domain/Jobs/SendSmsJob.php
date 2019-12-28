<?php

namespace PhpLab\Sandbox\Notify\Domain\Jobs;

use PhpLab\Sandbox\Notify\Domain\Entities\SmsEntity;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories\SmsRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobInterface;

class SendSmsJob implements JobInterface
{

    /** @var SmsEntity */
    public $entity;
    private $smsRepository;

    public function __construct(SmsRepositoryInterface $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    public function run() {
        $this->smsRepository->send($this->entity);
    }

}