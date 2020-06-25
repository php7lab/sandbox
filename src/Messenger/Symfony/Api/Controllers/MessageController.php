<?php

namespace PhpLab\Sandbox\Messenger\Symfony\Api\Controllers;

use PhpLab\Core\Domain\Exceptions\UnprocessibleEntityException;
use PhpLab\Rest\Base\BaseCrudApiController;
use PhpLab\Rest\Libs\Serializer\JsonRestSerializer;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Services\MessageServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends BaseCrudApiController
{

    public function __construct(MessageServiceInterface $chatService)
    {
        $this->service = $chatService;
    }
    
    public function sendMessageFromBot(Request $request, string $bot) {
        $response = new JsonResponse;
        $serializer = new JsonRestSerializer($response);
        try {
            $this->service->sendMessageFromBot($bot, $request->query->all());
            $serializer->serialize(['ok'=>true]);
        } catch (UnprocessibleEntityException $e) {
            $errorCollection = $e->getErrorCollection();
            $serializer->serialize($errorCollection);
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return $response;
    }
}
