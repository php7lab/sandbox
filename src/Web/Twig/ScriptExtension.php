<?php

namespace PhpLab\Sandbox\Web\Twig;

use PhpLab\Sandbox\Web\Widgets\PaginationWidget;
use PhpLab\Sandbox\Web\Widgets\WidgetInterface;
use PhpLab\Domain\Data\DataProviderEntity;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ScriptExtension extends AbstractExtension
{

    private $script = [];

    public function getFunctions()
    {
        return [
            new TwigFunction('script', [$this, 'script'], ['is_safe' => ['html']]),
            new TwigFunction('scriptList', [$this, 'scriptList'], ['is_safe' => ['html']]),
        ];
    }

    public function script($path, $attributes = [])
    {
        $this->script[] = [
            'path' => $path,
            'attributes' => $attributes,
        ];
    }

    public function scriptList()
    {
        return $this->script;
    }

}
