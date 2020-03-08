<?php

namespace PhpLab\Sandbox\Messenger\Domain\Services;

use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Services\MessageServiceInterface;

class MessageService extends BaseCrudService implements MessageServiceInterface
{

    public function __construct(MessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

}

