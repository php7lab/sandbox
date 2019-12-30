<?php

namespace PhpLab\Sandbox\Queue\Domain\Interfaces;

use Illuminate\Support\Collection;
use php7rails\domain\data\Query;
use PhpLab\Domain\Interfaces\CrudRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;

interface JobRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * Выбрать все необработанные задачи
     * @param Query|null $query
     * @return JobEntity[]
     */
    public function allNew(Query $query = null) : Collection;

}