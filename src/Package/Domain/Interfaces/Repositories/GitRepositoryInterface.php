<?php

namespace PhpLab\Sandbox\Package\Domain\Interfaces\Repositories;

use Illuminate\Support\Collection;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;

interface GitRepositoryInterface {

    public function allChanged();
    public function allVersion(PackageEntity $packageEntity);
    public function allCommit(PackageEntity $packageEntity) : Collection;
    public function allTag(PackageEntity $packageEntity) : Collection;
}
