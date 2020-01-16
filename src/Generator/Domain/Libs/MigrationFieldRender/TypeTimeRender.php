<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class TypeTimeRender extends BaseRender
{

    public function isMatch() : bool
    {
        return strpos($this->attributeName, '_at') == strlen($this->attributeName) - 3;
    }

    public function run() : string
    {
        return $this->renderCode('dateTime', $this->attributeName);
    }

}
