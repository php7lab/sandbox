<?php

namespace PhpLab\Sandbox\Socket\Domain\Entities;

use PhpLab\Sandbox\Socket\Domain\Enums\SocketEventStatusEnum;
use Symfony\Component\Console\Application;
use PhpLab\Core\Libs\Env\DotEnvHelper;
use Illuminate\Container\Container;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Workerman\Connection\ConnectionInterface;
use Workerman\Worker;

class SocketEventEntity {

    private $userId;
    private $name;
    private $status = SocketEventStatusEnum::OK;
    private $data;

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

}
