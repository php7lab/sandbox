<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class IdRender extends BaseRender
{

    public function isMatch() : bool
    {
        return $this->attributeName == 'id';
    }

    public function run() : string
    {
        $code = "\$table->integer('{$this->attributeName}')->autoIncrement();";
        return $code;
    }

}
