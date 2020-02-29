<?php

namespace PhpLab\Sandbox\Reference\Services;

use PhpLab\Sandbox\Reference\Interfaces\Services\ItemTranslationServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;

class ItemTranslationService extends BaseCrudService implements ItemTranslationServiceInterface
{

    public function __construct(\PhpLab\Sandbox\Reference\Interfaces\Repositories\ItemTranslationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}

