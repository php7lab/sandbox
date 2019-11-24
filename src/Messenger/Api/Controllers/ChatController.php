<?php

namespace PhpLab\Sandbox\Messenger\Api\Controllers;

use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Rest\Controllers\BaseCrudApiController;

class ChatController extends BaseCrudApiController
{

    public function __construct(ChatServiceInterface $chatService)
    {
        $this->service = $chatService;
    }

}
