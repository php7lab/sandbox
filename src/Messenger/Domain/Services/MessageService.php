<?php

namespace PhpLab\Sandbox\Messenger\Domain\Services;

use FOS\UserBundle\Model\FosUserInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Core\Domain\Exceptions\UnprocessibleEntityException;
use PhpLab\Sandbox\Messenger\Domain\Entities\MessageEntity;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Services\MessageServiceInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

class MessageService extends BaseCrudService implements MessageServiceInterface
{

    private $container;
    private $security;

    public function __construct(MessageRepositoryInterface $repository, ContainerInterface $container, Security $security)
    {
        $this->repository = $repository;
        $this->container = $container;
        $this->security = $security;
    }

    public function sendMessageFromBot(string $botToken, int $chatId, string $text) {
        list($botId, $botKey) = explode(':', $botToken);
        $message = new MessageEntity;
        $message->setAuthorId($botId);
        $message->setChatId($chatId);
        $message->setText($text);
        $this->repository->create($message);
        return $message;
    }

    public function sendMessage(int $chatId, string $text) {
        $message = new MessageEntity;
        $user = $this->security->getUser();
        //$user = $this->container->get('security.token_storage')->getToken()->getUser();
        $message->setAuthorId($user->getId());
        $message->setChatId($chatId);
        $message->setText($text);
        $this->repository->create($message);
        return $message;
    }
}
