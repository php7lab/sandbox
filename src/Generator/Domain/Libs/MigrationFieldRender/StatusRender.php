<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class StatusRender extends BaseRender
{

    public function isMatch() : bool
    {
        return $this->attributeName == 'status';
    }

    public function run() : string
    {
        $code = "\$table->smallInteger('{$this->attributeName}')->default(1)->comment('Статус');";
        return $code;
    }

}
