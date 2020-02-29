<?php

namespace PhpLab\Sandbox\Reference\Services;

use PhpLab\Sandbox\Reference\Interfaces\Services\ItemServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;

class ItemService extends BaseCrudService implements ItemServiceInterface
{

    public function __construct(\PhpLab\Sandbox\Reference\Interfaces\Repositories\ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

