<?php

namespace PhpLab\Sandbox\Crypt\Strategies\Func\Handlers;

use php7rails\domain\data\Query;
use PhpLab\Sandbox\Crypt\Dto\TokenDto;
use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;

interface HandlerInterface {

    public function sign($msg, $algorithm, $key);
    public function verify($msg, $algorithm, $key, $signature);
}
