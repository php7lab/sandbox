<?php

namespace PhpLab\Sandbox\User\Domain\Entity;

use php7rails\domain\BaseEntityWithId;

/**
 * Class Identity
 * @package PhpLab\Sandbox\User\Domain\Entity
 *
 * @property string $login
 * @property string $token
 */
class Identity extends BaseEntityWithId
{

    protected $login;
    protected $token;

}