<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class TypeBooleanRender extends BaseRender
{

    public function isMatch() : bool
    {
        return strpos($this->attributeName, 'is_') === 0;
    }

    public function run() : string
    {
        return $this->renderCode('boolean', $this->attributeName);
    }

}
