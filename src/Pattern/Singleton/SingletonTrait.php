<?php

namespace PhpLab\Sandbox\Pattern\Singleton;

class SingletonTrait implements SingletonInterface
{

    /**
     * @var static[]|array
     */
    private static $instances = [];

    public static function instance(boolean $refresh = false): object
    {
        $className = static::class;
        $isNotFound = ! isset(self::$instances[$className]);
        if ($refresh || $isNotFound) {
            self::$instances[$className] = new $className;
        }
        return self::$instances[$className];
    }

}