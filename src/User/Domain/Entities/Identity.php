<?php

namespace PhpLab\Sandbox\User\Domain\Entities;

use php7rails\domain\BaseEntityWithId;

/**
 * Class Identity
 * @package PhpLab\Sandbox\User\Domain\Entities
 *
 * @property string $login
 * @property string $token
 */
class Identity extends BaseEntityWithId
{

    protected $login;
    protected $token;

}