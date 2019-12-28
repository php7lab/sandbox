<?php

namespace PhpLab\Sandbox\Queue\Domain\Services;

use PhpLab\Domain\Helpers\EntityHelper;
use PhpLab\Domain\Services\BaseCrudService;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;
use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobServiceInterface;
use BadMethodCallException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JobService extends BaseCrudService implements JobServiceInterface
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(JobRepositoryInterface $repository, ContainerInterface $container)
    {
        $this->repository = $repository;
        $this->container = $container;
    }

    public function push(JobInterface $job, $priority = PriorityEnum::NORMAL)
    {
        $isAvailable = $this->beforeMethod([$this, 'push']);
        $jobEntity = new JobEntity;
        $jobEntity->setChannel('email');
        $jobEntity->setJob($job);
        $jobEntity->setPriority($priority);
        //$jobEntity->setDelay();
        EntityHelper::validate($jobEntity);
        //dd($this->container);
        //dd($jobEntity->getJob());
        //dd(gettype($jobEntity->getData()));

        return $job->run(); // return $jobEntity;

        $this->getRepository()->create($jobEntity);
        return $jobEntity;
    }

    public function runAll() {

    }

    /*public function create($data)
    {
        throw new BadMethodCallException('Deny method');
    }

    public function deleteById($id)
    {
        throw new BadMethodCallException('Deny method');
    }

    public function updateById($id, $data)
    {
        throw new BadMethodCallException('Deny method');
    }*/

}
