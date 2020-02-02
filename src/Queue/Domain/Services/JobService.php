<?php

namespace PhpLab\Sandbox\Queue\Domain\Services;

use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;
use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;
use PhpLab\Sandbox\Queue\Domain\Helpers\JobHelper;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JobService extends BaseCrudService implements JobServiceInterface
{

    protected $container;

    public function __construct(JobRepositoryInterface $repository, ContainerInterface $container)
    {
        $this->repository = $repository;
        $this->container = $container;
    }

    public function getRepository(): JobRepositoryInterface
    {
        return parent::getRepository();
    }

    public function push(JobInterface $job, int $priority = PriorityEnum::NORMAL)
    {
        $isAvailable = $this->beforeMethod([$this, 'push']);
        $jobEntity = new JobEntity;
        $jobEntity->setChannel('email');
        $jobEntity->setJob($job);
        $jobEntity->setPriority($priority);
        //$jobEntity->setDelay();
        EntityHelper::validate($jobEntity);
        $this->getRepository()->create($jobEntity);
        return $jobEntity;
    }

    public function runAll(string $channel = null): int
    {
        $jobCollection = $this->getRepository()->allForRun();
        foreach ($jobCollection as $jobEntity) {
            $job = JobHelper::forgeJob($jobEntity, $this->container);
            $job->run();
            $jobEntity->setReservedAt();
            $jobEntity->setDoneAt();
            $this->getRepository()->update($jobEntity);
        }
        return $jobCollection->count();
    }

}
