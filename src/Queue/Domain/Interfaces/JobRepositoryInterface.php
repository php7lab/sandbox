<?php

namespace PhpLab\Sandbox\Queue\Domain\Interfaces;

use Illuminate\Support\Collection;
use PhpLab\Domain\Data\Query;
use PhpLab\Domain\Interfaces\Repository\CrudRepositoryInterface;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;

interface JobRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * Выбрать невыполненные и зависшие задачи
     * @param Query|null $query
     * @return JobEntity[]
     */
    public function allForRun(Query $query = null): Collection;

}