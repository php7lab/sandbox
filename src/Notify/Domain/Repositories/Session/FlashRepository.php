<?php

namespace PhpLab\Sandbox\Notify\Domain\Repositories\Session;

use LogicException;
use PhpLab\Core\Traits\InjectContainerTrait;
use PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories\FlashRepositoryInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FlashRepository implements FlashRepositoryInterface
{

    use InjectContainerTrait;

    public function add(string $type, string $message)
    {
        $this->getSession()->getFlashBag()->add($type, $message);
    }

    /**
     * @return Session | SessionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function getSession(): SessionInterface
    {
        if ( ! $this->container->has('session')) {
            throw new LogicException('You can not use the addFlash method if sessions are disabled. Enable them in "config/packages/framework.yaml".');
        }
        return $this->container->get('session');
    }
}
