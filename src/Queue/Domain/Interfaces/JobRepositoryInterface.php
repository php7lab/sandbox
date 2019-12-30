<?php

namespace PhpLab\Sandbox\Queue\Domain\Interfaces;

use Illuminate\Support\Collection;
use php7rails\domain\data\Query;
use PhpLab\Domain\Interfaces\CrudRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;

interface JobRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * Выбрать невыполненные и зависшие задачи
     * @param Query|null $query
     * @return JobEntity[]
     */
    public function allForRun(Query $query = null) : Collection;

}