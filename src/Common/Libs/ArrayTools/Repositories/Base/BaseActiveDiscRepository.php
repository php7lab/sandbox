<?php

namespace PhpLab\Sandbox\Common\Libs\ArrayTools\Repositories\Base;

use php7rails\domain\interfaces\repositories\CrudInterface;
use PhpLab\Sandbox\Common\Libs\ArrayTools\Traits\ArrayModifyTrait;
use PhpLab\Sandbox\Common\Libs\ArrayTools\Traits\ArrayReadTrait;

abstract class BaseActiveDiscRepository extends BaseDiscRepository implements CrudInterface
{

    use ArrayReadTrait;
    use ArrayModifyTrait;

}