<?php

namespace PhpLab\Sandbox\Reference\Services;

use PhpLab\Sandbox\Reference\Interfaces\Services\BookServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;

class BookService extends BaseCrudService implements BookServiceInterface
{

    public function __construct(\PhpLab\Sandbox\Reference\Interfaces\Repositories\BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

