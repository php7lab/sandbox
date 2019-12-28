<?php

namespace PhpLab\Sandbox\Notify\Domain\Services;

use PhpLab\Sandbox\Notify\Domain\Entities\EmailEntity;
use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use PhpLab\Sandbox\Notify\Domain\Jobs\SendEmailJob;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobServiceInterface;

class EmailService implements EmailServiceInterface
{

    private $emailRepository;
    private $jobService;

    public function __construct(EmailRepositoryInterface $emailRepository, JobServiceInterface $jobService)
    {
        $this->emailRepository = $emailRepository;
        $this->jobService = $jobService;
    }

    public function push(EmailEntity $emailEntity, $priority = PriorityEnum::NORMAL) {
        $emailJob = new SendEmailJob($this);
        $emailJob->entity = $emailEntity;
        $pushResult = $this->jobService->push($emailJob);
        //dd($pushResult);
    }

    public function send(EmailEntity $emailEntity) {
        $this->emailRepository->send($emailEntity);
    }

}
