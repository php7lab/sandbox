<?php

namespace PhpLab\Sandbox\User\Domain\Forms;

use PhpLab\Core\Common\Helpers\ClassHelper;

class AuthForm
{

    public $login;
    public $password;

    public function __construct($data)
    {
        ClassHelper::configure($this, $data);
    }

}