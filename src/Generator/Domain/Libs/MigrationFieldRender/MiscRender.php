<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class MiscRender extends BaseRender
{

    public function isMatch() : bool
    {
        return true;
    }

    public function run() : string
    {
        $code = "\$table->string('{$this->attributeName}')->comment('');";
        return $code;
    }

}
