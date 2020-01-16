<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class TypeIntegerRender extends BaseRender
{

    public function isMatch() : bool
    {
        return strpos($this->attributeName, '_id') === mb_strlen($this->attributeName) - 3;
    }

    public function run() : string
    {
        $code = "\$table->integer('{$this->attributeName}')->comment('');";
        return $code;
    }

}
