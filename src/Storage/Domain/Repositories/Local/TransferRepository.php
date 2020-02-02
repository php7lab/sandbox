<?php

namespace PhpLab\Sandbox\Storage\Domain\Repositories\Local;

use PhpLab\Core\Domain\Traits\ForgeEntityTrait;
use PhpLab\Sandbox\Storage\Domain\Interfaces\Repositories\TransferRepositoryInterface;

class TransferRepository implements TransferRepositoryInterface
{

    use ForgeEntityTrait;

    protected $tableName = 'storage_transfer';

    public function getEntityClass(): string
    {
        return 'PhpLab\\Sandbox\\Storage\\Domain\\Entities\\TransferEntity';
    }

}
