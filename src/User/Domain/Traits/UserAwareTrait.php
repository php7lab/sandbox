<?php

namespace PhpLab\Sandbox\User\Domain\Traits;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

trait UserAwareTrait
{

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage = null;

    public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getUser() : UserInterface {
        return $this->tokenStorage->getToken()->getUser();
    }

}