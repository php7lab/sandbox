<?php

namespace PhpLab\Sandbox\Notify\Domain\Jobs;

use PhpLab\Sandbox\Notify\Domain\Entities\EmailEntity;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class SendEmailJob implements JobInterface
{

    use ContainerAwareTrait;

    /** @var EmailEntity */
    public $entity;

    public function run()
    {
        /** @var EmailRepositoryInterface $emailRepository */
        $emailRepository = $this->container->get(EmailRepositoryInterface::class);
        $emailRepository->send($this->entity);
    }

}