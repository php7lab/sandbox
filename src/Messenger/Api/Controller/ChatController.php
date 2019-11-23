<?php

namespace PhpLab\Sandbox\Messenger\Api\Controller;

use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Rest\Controller\BaseCrudApiController;

class ChatController extends BaseCrudApiController
{

    public function __construct(ChatServiceInterface $chatService)
    {
        $this->service = $chatService;
    }

}
