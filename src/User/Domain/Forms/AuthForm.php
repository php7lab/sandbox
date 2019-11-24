<?php

namespace PhpLab\Sandbox\User\Domain\Forms;

use php7extension\core\helpers\ClassHelper;

class AuthForm
{

    public $login;
    public $password;

    public function __construct($data)
    {
        ClassHelper::configure($this, $data);
    }

}