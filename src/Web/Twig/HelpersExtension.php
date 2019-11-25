<?php

namespace PhpLab\Sandbox\Web\Twig;

use PhpLab\Sandbox\Web\Widgets\PaginationWidget;
use PhpLab\Sandbox\Web\Widgets\WidgetInterface;
use PhpLab\Domain\Data\DataProviderEntity;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class HelpersExtension extends AbstractExtension
{

    private $script = [];
    private $style = [];

    public function getFunctions()
    {
        return [
            new TwigFunction('asset', [$this, 'asset'], ['is_safe' => ['html']]),
            new TwigFunction('widget', [$this, 'widget'], ['is_safe' => ['html']]),
            new TwigFunction('pagination', [$this, 'pagination'], ['is_safe' => ['html']]),

            new TwigFunction('script', [$this, 'script'], ['is_safe' => ['html']]),
            new TwigFunction('scriptList', [$this, 'scriptList'], ['is_safe' => ['html']]),

            new TwigFunction('style', [$this, 'style'], ['is_safe' => ['html']]),
            new TwigFunction('styleList', [$this, 'styleList'], ['is_safe' => ['html']]),
        ];
    }

    public function widget($widgetClass, $params)
    {
        /** @var WidgetInterface $widget */
        $widget = new $widgetClass;
        foreach ($params as $paramName => $paramValue) {
            $widget->{$paramName} = $paramValue;
        }
        return $widget->render();
    }

    public function pagination(DataProviderEntity $dataProviderEntity)
    {
        $widgetInstance = new PaginationWidget($dataProviderEntity);
        return $widgetInstance->render();
    }

    public function asset($path, $param = null)
    {
        return $path;
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
