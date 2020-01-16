<?php

namespace PhpLab\Sandbox\Generator\Domain\Libs\MigrationFieldRender;

abstract class BaseRender
{

    public $attributeName;

    abstract public function isMatch() : bool;
    abstract public function run() : string;

    protected function renderCode(string $type, string $attributeName, string $comment = '', string $extra = null) {
        $code = "\$table->{$type}('{$attributeName}')";
        if($extra) {
            $code .= $extra;
        }
        //if($comment) {
            $code .= "->comment('{$comment}')";
        //}
        return $code . ';';
    }

}
