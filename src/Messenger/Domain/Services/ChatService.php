<?php

namespace PhpLab\Sandbox\Messenger\Domain\Services;

use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Services\BaseCrudService;

/**
 * @property ChatRepositoryInterface | GetEntityClassInterface $repository
 */
class ChatService extends BaseCrudService implements ChatServiceInterface
{

    public function __construct(ChatRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

}