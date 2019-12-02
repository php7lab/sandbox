<?php

namespace PhpLab\Sandbox\Web\Twig;

use PhpLab\Sandbox\Web\Widgets\PaginationWidget;
use PhpLab\Sandbox\Web\Widgets\WidgetInterface;
use PhpLab\Domain\Data\DataProviderEntity;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class StyleExtension extends AbstractExtension
{

    private $style = [];

    public function getFunctions()
    {
        return [
            new TwigFunction('style', [$this, 'style'], ['is_safe' => ['html']]),
            new TwigFunction('styleList', [$this, 'styleList'], ['is_safe' => ['html']]),
        ];
    }

    public function style($path, $attributes = [])
    {
        $this->style[] = [
            'path' => $path,
            'attributes' => $attributes,
        ];
    }

    public function styleList()
    {
        return $this->style;
    }

}
