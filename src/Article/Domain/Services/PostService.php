<?php

namespace PhpLab\Sandbox\Article\Domain\Services;

use PhpLab\Sandbox\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpLab\Sandbox\Article\Domain\Interfaces\PostServiceInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Services\BaseCrudService;

/**
 * Class PostService
 * @package PhpLab\Sandbox\Article\Domain\Services
 *
 * @property PostRepositoryInterface | GetEntityClassInterface $repository
 */
class PostService extends BaseCrudService implements PostServiceInterface
{

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

}