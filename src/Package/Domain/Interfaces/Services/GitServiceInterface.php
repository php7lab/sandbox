<?php

namespace PhpLab\Sandbox\Package\Domain\Interfaces\Services;

use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;

interface GitServiceInterface
{

    public function lastVersion(PackageEntity $packageEntity);

    public function pullPackage(PackageEntity $packageEntity);

    public function isNeedRelease(PackageEntity $packageEntity): bool;

    public function isHasChanges(PackageEntity $packageEntity): bool;

    public function allChanged();

}
