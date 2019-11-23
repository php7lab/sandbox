<?php

namespace PhpLab\Sandbox\Bundle\Article\Domain\Service;

use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\PostServiceInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Service\BaseCrudService;

/**
 * Class PostService
 * @package PhpLab\Sandbox\Bundle\Article\Domain\Service
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