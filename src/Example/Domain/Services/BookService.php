<?php

namespace PhpLab\Sandbox\Example\Domain\Services;

use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Sandbox\Example\Domain\Interfaces\Repositories\BookRepositoryInterface;
use PhpLab\Sandbox\Example\Domain\Interfaces\Services\BookServiceInterface;

class BookService extends BaseCrudService implements BookServiceInterface
{

    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

}
