<?php

namespace PhpLab\Sandbox\Package\Domain\Services;

use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GroupRepository;

class GroupService extends BaseCrudService
{

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

}
