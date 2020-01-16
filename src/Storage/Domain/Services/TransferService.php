<?php

namespace PhpLab\Sandbox\Storage\Domain\Services;

use PhpLab\Sandbox\Storage\Domain\Interfaces\Services\TransferServiceInterface;
use PhpLab\Domain\Services\BaseCrudService;

class TransferService extends BaseCrudService implements TransferServiceInterface
{

    public function __construct(\PhpLab\Sandbox\Storage\Domain\Interfaces\Repositories\TransferRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

