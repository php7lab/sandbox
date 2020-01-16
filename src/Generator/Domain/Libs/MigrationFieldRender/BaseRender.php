<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

abstract class BaseRender
{

    public $attributeName;

    abstract public function isMatch() : bool;
    abstract public function run() : string;

}
