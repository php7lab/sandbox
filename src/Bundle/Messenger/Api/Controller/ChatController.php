<?php

namespace PhpLab\Sandbox\Bundle\Messenger\Api\Controller;

use PhpLab\Sandbox\Bundle\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Rest\Controller\BaseCrudApiController;

class ChatController extends BaseCrudApiController
{

    public function __construct(ChatServiceInterface $chatService)
    {
        $this->service = $chatService;
    }

}
