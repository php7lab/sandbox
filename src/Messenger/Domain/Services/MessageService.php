<?php

namespace PhpLab\Sandbox\Messenger\Domain\Services;

use FOS\UserBundle\Model\FosUserInterface;
use GuzzleHttp\Client;
use PhpBundle\User\Domain\Exceptions\UnauthorizedException;
use PhpBundle\User\Domain\Interfaces\UserRepositoryInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Core\Domain\Exceptions\UnprocessibleEntityException;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Rest\Contract\Client\RestClient;
use PhpLab\Sandbox\Messenger\Domain\Entities\BotEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\ChatEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\FlowEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\MessageEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\FlowRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Repositories\BotRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Services\MessageServiceInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class MessageService extends BaseCrudService implements MessageServiceInterface
{

    private $chatService;
    private $security;
    private $flowRepository;
    private $botRepository;
    private $userRepository;
    private $botService;

    public function __construct(
        MessageRepositoryInterface $repository,
        BotService $botService,
        UserRepositoryInterface $userRepository,
        BotRepositoryInterface $botRepository,
        FlowRepositoryInterface $flowRepository,
        ChatService $chatService,
        Security $security)
    {
        $this->repository = $repository;
        $this->botRepository = $botRepository;
        $this->flowRepository = $flowRepository;
        $this->userRepository = $userRepository;
        $this->chatService = $chatService;
        $this->security = $security;
        $this->botService = $botService;
    }

    public function createEntity(array $attributes = []): MessageEntity
    {
        $entity = parent::createEntity($attributes);
        $user = $this->security->getUser();
        $entity->setAuthorId($user->getId());
        return $entity;
    }

    protected function forgeQuery(Query $query = null)
    {
        return parent::forgeQuery($query)->with('author');
    }

    public function sendMessageFromBot($botToken, array $request)
    {
        $botEntity = $this->botService->authByToken($botToken);
        $chatEntity = $this->chatService->repository->oneByIdWithMembers($request['chat_id']);

        $messageEntity = new MessageEntity;
        $messageEntity->setAuthorId($botEntity->getUserId());
        $messageEntity->setChatId($chatEntity->getId());
        $messageEntity->setChat($chatEntity);
        $messageEntity->setText($request['text']);
        $this->repository->create($messageEntity);
        $this->sendFlow($messageEntity);
        return $messageEntity;
    }

    public function sendMessage(int $chatId, string $text)
    {
        $chatEntity = $this->chatService->repository->oneByIdWithMembers($chatId);
        $messageEntity = $this->createEntity();
        $messageEntity->setChatId($chatId);
        $messageEntity->setChat($chatEntity);
        $messageEntity->setText($text);
        $this->repository->create($messageEntity);
        $this->sendFlow($messageEntity);
        return $messageEntity;
    }

    private function sendFlow(MessageEntity $messageEntity)
    {
        $chatEntity = $messageEntity->getChat();
        $author = $this->userRepository->oneById($messageEntity->getAuthorId());
        $messageEntity->setAuthor($author);
        foreach ($chatEntity->getMembers() as $memberEntity) {
            $roles = $memberEntity->getUser()->getRolesArray();
            if (in_array('ROLE_BOT', $roles)) {
                if($messageEntity->getAuthorId() != $memberEntity->getUserId()) {
                    $this->sendMessageToBot($memberEntity->getUser(), $messageEntity);
                }
            } else {
                $flowEntity = new FlowEntity;
                $flowEntity->setChatId($chatEntity->getId());
                $flowEntity->setMessageId($messageEntity->getId());
                $flowEntity->setUserId($memberEntity->getUserId());
                $this->flowRepository->create($flowEntity);
            }
        }
    }

    public function sendMessageToBot(UserInterface $botIdentity, MessageEntity $messageEntity)
    {
        $data = [
            "update_id" => $messageEntity->getId(),
            "message" => [
                "message_id" => $messageEntity->getId(),
                "from" => [
                    "id" => $messageEntity->getAuthorId(),
                    "is_bot" => false,
                    "first_name" => $messageEntity->getAuthor()->getUsername(),
                    "username" => $messageEntity->getAuthor()->getUsername(),
                    "language_code" => "ru",
                ],
                "chat" => [
                    "id" => $messageEntity->getChatId(),
                    "first_name" => $messageEntity->getChat()->getTitle(),
                    "username" => $messageEntity->getChat()->getTitle(),
                    "type" => 'private',
                ],
                "date" => time(),
                "text" => $messageEntity->getText(),
            ]
        ];

        $botEntity = $this->botRepository->oneByUserId($botIdentity->getId());
        $client = new Client(['base_uri' => $botEntity->getHookUrl()]);
        $response = $client->request('POST', '', [
            'json' => $data,
        ]);
    }
}
