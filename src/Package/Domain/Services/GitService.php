<?php

namespace PhpLab\Sandbox\Package\Domain\Services;

use php7rails\domain\data\Query;
use php7tool\vendor\domain\helpers\GitShell;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\GitServiceInterface;
use PhpLab\Sandbox\Package\Domain\Interfaces\Repositories\GitRepositoryInterface;
use PhpLab\Domain\Services\BaseService;

class GitService extends BaseService implements GitServiceInterface {

    public function __construct(GitRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function pullPackage(PackageEntity $packageEntity)
    {
        $git = new GitShell($packageEntity->getDirectory());
        $result = $git->pullWithInfo();
        if($result == 'Already up-to-date.') {
            return false;
        } else {
            return $result;
        }
    }

    public function allChanged()
    {
        return $this->repository->allChanged();
    }
}
