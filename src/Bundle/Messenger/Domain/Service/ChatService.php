<?php

namespace PhpLab\Sandbox\Bundle\Messenger\Domain\Service;

use PhpLab\Sandbox\Bundle\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Sandbox\Bundle\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Service\BaseCrudService;

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