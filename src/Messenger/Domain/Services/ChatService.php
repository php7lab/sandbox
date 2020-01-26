<?php

namespace PhpLab\Sandbox\Messenger\Domain\Services;

use PhpLab\Domain\Data\Query;
use PhpLab\Domain\Helpers\EntityHelper;
use PhpLab\Domain\Interfaces\GetEntityClassInterface;
use PhpLab\Domain\Services\BaseCrudService;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Sandbox\Messenger\Domain\Repositories\Eloquent\MemberRepository;
use PhpLab\Sandbox\User\Domain\Entities\User;
use PhpLab\Sandbox\User\Domain\Traits\UserAwareTrait;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @property ChatRepositoryInterface | GetEntityClassInterface $repository
 */
class ChatService extends BaseCrudService implements ChatServiceInterface
{

    use UserAwareTrait;

    private $memberRepository;

    public function __construct(TokenStorageInterface $tokenStorage, ChatRepositoryInterface $repository, MemberRepository $memberRepository)
    {
        $this->repository = $repository;
        $this->setTokenStorage($tokenStorage);
        $this->memberRepository = $memberRepository;
    }

    private function allSelfChatIds(): array
    {
        /** @var User $userEntity */
        $userEntity = $this->getUser();

        $memberQuery = Query::forge();
        $memberQuery->where('user_id', $userEntity->getId());
        $memberCollection = $this->memberRepository->all($memberQuery);

        $chatIdArray = EntityHelper::getColumn($memberCollection, 'chatId');
        return $chatIdArray;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $chatIdArray = $this->allSelfChatIds();
        $query->where('id', $chatIdArray);
        return $query;
    }

    public function create($data)
    {
        // todo: create by self user id
        return parent::create($data);
    }

    public function updateById($id, $data)
    {
        // todo:
        return parent::updateById($id, $data);
    }

    public function deleteById($id)
    {
        // todo:
        return parent::deleteById($id);
    }

}