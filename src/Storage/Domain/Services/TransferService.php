<?php

namespace PhpLab\Sandbox\Storage\Domain\Services;

use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Sandbox\Storage\Domain\Interfaces\Services\TransferServiceInterface;

class TransferService extends BaseCrudService implements TransferServiceInterface
{

    public function __construct(\PhpLab\Sandbox\Storage\Domain\Interfaces\Repositories\TransferRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

