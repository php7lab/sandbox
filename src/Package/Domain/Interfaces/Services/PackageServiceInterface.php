<?php

namespace PhpLab\Sandbox\Package\Domain\Interfaces\Services;

use Illuminate\Support\Collection;
use php7rails\domain\data\Query;
use PhpLab\Domain\Interfaces\CrudServiceInterface;

interface PackageServiceInterface extends CrudServiceInterface {

    public function allChanged(Query $query = null) : Collection;

}
