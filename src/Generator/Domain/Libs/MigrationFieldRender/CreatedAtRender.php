<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class CreatedAtRender extends BaseRender
{

    public function isMatch() : bool
    {
        return $this->attributeName == 'created_at';
    }

    public function run() : string
    {
        $code = "\$table->dateTime('{$this->attributeName}')->comment('Время создания');";
        return $code;
    }

}
