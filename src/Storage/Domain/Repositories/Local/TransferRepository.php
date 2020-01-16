<?php

namespace PhpLab\Sandbox\Storage\Domain\Repositories\Local;

use PhpLab\Domain\Repositories\BaseRepository;
use PhpLab\Sandbox\Storage\Domain\Interfaces\Repositories\TransferRepositoryInterface;

class TransferRepository extends BaseRepository implements TransferRepositoryInterface
{

    protected $tableName = 'storage_transfer';

    protected $entityClass = 'PhpLab\\Sandbox\\Storage\\Domain\\Entities\\TransferEntity';


}

