<?php

namespace PhpLab\Sandbox\Queue\Domain\Services;

use Illuminate\Support\Collection;
use php7rails\domain\data\Query;
use php7rails\domain\data\query\Where;
use PhpLab\Domain\Helpers\EntityHelper;
use PhpLab\Domain\Services\BaseCrudService;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;
use PhpLab\Sandbox\Queue\Domain\Enums\PriorityEnum;
use PhpLab\Sandbox\Queue\Domain\Helpers\JobHelper;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobServiceInterface;
use BadMethodCallException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JobService extends BaseCrudService implements JobServiceInterface
{

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
        $this->getRepository()->create($jobEntity);
        return $jobEntity;
    }

    public function runAll() {
        $where = new Where;
        $where->column = 'done_at';
        $where->value = null;
        $query = new Query;
        $query->whereNew($where);
        /** @var JobEntity[] | Collection | array $jobCollection */
        $jobCollection = $this->getRepository()->all($query);
        foreach ($jobCollection as $jobEntity) {
            $job = JobHelper::forgeJob($jobEntity, $this->container);
            $job->run();
            $jobEntity->setReservedAt();
            $jobEntity->setDoneAt();
            $this->getRepository()->update($jobEntity);
        }
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
