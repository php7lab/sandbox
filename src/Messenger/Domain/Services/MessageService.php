<?php

namespace PhpLab\Sandbox\Messenger\Domain\Services;

use FOS\UserBundle\Model\FosUserInterface;
use GuzzleHttp\Client;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Core\Domain\Exceptions\UnprocessibleEntityException;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Rest\Contract\Client\RestClient;
use PhpLab\Sandbox\Messenger\Domain\Entities\ChatEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\FlowEntity;
use PhpLab\Sandbox\Messenger\Domain\Entities\MessageEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\FlowRepositoryInterface;
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

    public function __construct(MessageRepositoryInterface $repository, FlowRepositoryInterface $flowRepository, ChatService $chatService, Security $security)
    {
        $this->repository = $repository;
        $this->flowRepository = $flowRepository;
        $this->chatService = $chatService;
        $this->security = $security;
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
        //dd($request);
        $chatId = $request['chat_id'];
        $text = $request['text'];
        list($botId, $botKey) = explode(':', $botToken);
        $message = new MessageEntity;
        $message->setAuthorId($botId);
        $message->setChatId($chatId);
        $message->setText($text);
        $this->repository->create($message);
        $this->sendMessage($chatId, $text);
        return $message;
    }

    public function sendMessage(int $chatId, string $text)
    {
        $query = new Query;
        $query->with('members.user');
        /** @var ChatEntity $chatEntity */
        $chatEntity = $this->chatService->oneById($chatId, $query);
        //dd($chatEntity);
        $messageEntity = $this->createEntity();

        //$user = $this->container->get('security.token_storage')->getToken()->getUser();
        //$messageEntity->setAuthorId($user->getId());
        $messageEntity->setChatId($chatId);
        $messageEntity->setChat($chatEntity);
        /*

        dd($chatEntity);*/
        $messageEntity->setText($text);
        $this->repository->create($messageEntity);

        $this->sendFlow($chatEntity, $messageEntity);
        return $messageEntity;
    }

    private function sendFlow(ChatEntity $chatEntity, MessageEntity $messageEntity)
    {
        foreach ($chatEntity->getMembers() as $memberEntity) {
            $roles = $memberEntity->getUser()->getRolesArray();
            if (in_array('ROLE_BOT', $roles)) {
                $this->sendMessageToBot($memberEntity->getUser(), $messageEntity);
            }
            $flowEntity = new FlowEntity;
            $flowEntity->setChatId($chatEntity->getId());
            $flowEntity->setMessageId($messageEntity->getId());
            $flowEntity->setUserId($memberEntity->getUserId());
            $this->flowRepository->create($flowEntity);
        }
    }

    public function sendMessageToBot(UserInterface $botIdentity, MessageEntity $messageEntity)
    {
        $me = $this->security->getUser();
        $data = [
            "update_id" => $messageEntity->getId(),
            "message" => [
                "message_id" => $messageEntity->getId(),
                "from" => [
                    "id" => $messageEntity->getAuthorId(),
                    "is_bot" => false,
                    "first_name" => $me->getUsername(),
                    "username" => $me->getUsername(),
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
        $url = 'http://test.bot/bot.php?token=773713470:AAHTBIYMDvcreuZBxKpvAQWVLOQOG24F-mE';
        
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('POST', '', [
            'json' => $data,
        ]);
    }
}
