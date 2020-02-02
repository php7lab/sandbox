<?php

namespace PhpLab\Sandbox\Storage\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\Storage\Domain\Interfaces\Repositories\FileRepositoryInterface;

class FileRepository extends BaseEloquentCrudRepository implements FileRepositoryInterface
{

    protected $tableName = 'storage_file';

    public function getEntityClass(): string
    {
        return 'PhpLab\\Sandbox\\Storage\\Domain\\Entities\\FileEntity';
    }
}

