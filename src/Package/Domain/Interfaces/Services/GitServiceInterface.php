<?php

namespace PhpLab\Sandbox\Package\Domain\Interfaces\Services;

use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;

interface GitServiceInterface {

    public function pullPackage(PackageEntity $packageEntity);
    public function allChanged();

}
