<?php

namespace PhpLab\Sandbox\Common\Libs\ArrayTools\Repositories\Base;

use php7rails\domain\interfaces\repositories\CrudInterface;
use php7rails\domain\repositories\BaseRepository;
use PhpLab\Sandbox\Common\Libs\ArrayTools\Traits\ArrayModifyTrait;
use PhpLab\Sandbox\Common\Libs\ArrayTools\Traits\ArrayReadTrait;

abstract class BaseActiveArrayRepository extends BaseRepository implements CrudInterface
{

    use ArrayReadTrait;
    use ArrayModifyTrait;

    private $collection = [];

    protected function setCollection(Array $collection)
    {
        $this->collection = $collection;
    }

    protected function getCollection()
    {
        return $this->collection;
    }
}
