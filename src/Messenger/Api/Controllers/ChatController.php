<?php

namespace PhpLab\Sandbox\Messenger\Api\Controllers;

use PhpLab\Rest\Controllers\BaseCrudApiController;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatServiceInterface;

class ChatController extends BaseCrudApiController
{

    public function __construct(ChatServiceInterface $chatService)
    {
        $this->service = $chatService;
    }

}
