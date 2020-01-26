<?php

namespace PhpLab\Sandbox\Crypt\Strategies\Func\Handlers;

use PhpLab\Domain\Data\Query;
use PhpLab\Sandbox\Crypt\Dto\TokenDto;
use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;

interface HandlerInterface {

    public function sign($msg, $algorithm, $key);
    public function verify($msg, $algorithm, $key, $signature);
}
