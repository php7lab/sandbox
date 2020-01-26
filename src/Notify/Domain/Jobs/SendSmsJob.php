<?php

namespace PhpLab\Sandbox\Notify\Domain\Jobs;

use PhpLab\Sandbox\Notify\Domain\Entities\SmsEntity;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class SendSmsJob implements JobInterface
{

    use ContainerAwareTrait;

    /** @var SmsEntity */
    public $entity;

    public function run()
    {
        $this->smsRepository->send($this->entity);
    }

}