<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

class UpdatedAtRender extends BaseRender
{

    public function isMatch() : bool
    {
        return $this->attributeName == 'updated_at';
    }

    public function run() : string
    {
        $code = "\$table->dateTime('{$this->attributeName}')->nullable()->comment('Время обновления');";
        return $code;
    }

}
