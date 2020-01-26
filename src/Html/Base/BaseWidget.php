<?php

namespace PhpLab\Sandbox\Html\Base;

use PhpLab\Sandbox\Html\Interfaces\WidgetInterface;

abstract class BaseWidget implements WidgetInterface
{

    abstract public function render(): string;

    protected function renderTemplate(string $templateCode, array $params)
    {
        $newParams = [];
        foreach ($params as $name => $value) {
            $name = '{' . $name . '}';
            $newParams[$name] = $value;
        }
        return strtr($templateCode, $newParams);
    }
}