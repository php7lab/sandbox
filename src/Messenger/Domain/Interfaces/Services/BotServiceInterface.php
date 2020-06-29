<?php

namespace PhpLab\Sandbox\Messenger\Domain\Interfaces\Services;

use PhpLab\Core\Domain\Interfaces\Service\CrudServiceInterface;
use PhpLab\Sandbox\Messenger\Domain\Entities\BotEntity;

interface BotServiceInterface extends CrudServiceInterface
{

    public function authByToken(string $botToken): BotEntity;
}
