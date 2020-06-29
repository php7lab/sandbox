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
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Services\BotServiceInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\Services\MessageServiceInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class BotService extends BaseCrudService implements BotServiceInterface
{

    private $botRepository;
    private $security;
    private $userRepository;

    public function __construct(
        BotRepositoryInterface $botRepository, 
        UserRepositoryInterface $userRepository, 
        Security $security)
    {
        $this->botRepository = $botRepository;
        $this->security = $security;
        $this->userRepository = $userRepository;
    }

    public function authByToken(string $botToken): BotEntity {
        list($botId) = explode(':', $botToken);

        $botEntity = $this->botRepository->oneByUserId($botId);
        if($botToken != $botEntity->getToken()) {
            throw new UnauthorizedException();
        }
        $userEntity = $this->userRepository->oneById($botEntity->getUserId());
        $this->security->getToken()->setUser($userEntity);
        return $botEntity;
    }
}
