<?php

namespace PhpLab\Sandbox\Queue\Domain\Interfaces;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Data\Query;
use PhpLab\Core\Domain\Interfaces\Repository\CrudRepositoryInterface;
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