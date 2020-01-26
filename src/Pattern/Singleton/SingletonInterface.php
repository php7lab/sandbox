<?php

namespace PhpLab\Sandbox\Pattern\Singleton;

interface SingletonInterface
{

    public static function instance(boolean $refresh = false): object;

}