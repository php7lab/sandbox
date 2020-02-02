<?php

namespace PhpLab\Sandbox\Queue\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Data\Query;
use PhpLab\Core\Domain\Entities\Query\Where;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Queue\Domain\Entities\JobEntity;
use PhpLab\Sandbox\Queue\Domain\Interfaces\JobRepositoryInterface;

class JobRepository extends BaseEloquentCrudRepository implements JobRepositoryInterface
{

    protected $tableName = 'queue_job';

    public function getEntityClass(): string
    {
        return JobEntity::class;
    }

    public function allForRun(Query $query = null): Collection
    {
        $where = new Where;
        $where->column = 'done_at';
        $where->value = null;
        $query = Query::forge($query);
        $query->whereNew($where);
        $query->orderBy([
            'priority' => SORT_DESC,
            'pushed_at' => SORT_ASC,
        ]);
        return $this->all($query);
    }

}
