<?php

namespace PhpLab\Sandbox\Article\Domain\Services;

use PhpLab\Core\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Sandbox\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpLab\Sandbox\Article\Domain\Interfaces\PostServiceInterface;

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