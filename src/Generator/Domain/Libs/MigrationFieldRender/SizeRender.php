<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class SizeRender extends BaseRender
{

    public function isMatch() : bool
    {
        return $this->attributeName == 'size';
    }

    public function run() : string
    {
        $code = "\$table->integer('{$this->attributeName}')->comment('Размер');";
        return $code;
    }

}
