<?php

namespace PhpLab\Sandbox\Crypt\Strategies\Func\Handlers;

interface HandlerInterface
{

    public function sign($msg, $algorithm, $key);

    public function verify($msg, $algorithm, $key, $signature);
}
