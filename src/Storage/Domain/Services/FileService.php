<?php

namespace PhpLab\Sandbox\Storage\Domain\Services;

use PhpLab\Sandbox\Storage\Domain\Interfaces\Services\FileServiceInterface;
use PhpLab\Domain\Services\BaseCrudService;

class FileService extends BaseCrudService implements FileServiceInterface
{

    public function __construct(\PhpLab\Sandbox\Storage\Domain\Interfaces\Repositories\FileRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

