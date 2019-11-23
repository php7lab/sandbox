<?php

namespace PhpLab\Sandbox\Bundle\User\Domain\Entity;

use php7rails\domain\BaseEntityWithId;

/**
 * Class Identity
 * @package PhpLab\Sandbox\Bundle\User\Domain\Entity
 *
 * @property string $login
 * @property string $token
 */
class Identity extends BaseEntityWithId
{

    protected $login;
    protected $token;

}