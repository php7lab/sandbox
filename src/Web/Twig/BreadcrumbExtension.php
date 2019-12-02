<?php

namespace PhpLab\Sandbox\Web\Twig;

use PhpLab\Sandbox\Web\Widgets\BreadcrumbWidget;
use PhpLab\Sandbox\Web\Widgets\PaginationWidget;
use PhpLab\Sandbox\Web\Widgets\WidgetInterface;
use PhpLab\Domain\Data\DataProviderEntity;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BreadcrumbExtension extends AbstractExtension
{

    private $items = [];

    public function getFunctions()
    {
        return [
            new TwigFunction('breadcrumb', [$this, 'breadcrumb'], ['is_safe' => ['html']]),
            new TwigFunction('breadcrumbAdd', [$this, 'breadcrumbAdd'], ['is_safe' => ['html']]),
            new TwigFunction('breadcrumbList', [$this, 'breadcrumbList'], ['is_safe' => ['html']]),
        ];
    }

    public function breadcrumb()
    {
        $widgetInstance = new BreadcrumbWidget($this->items);
        return $widgetInstance->render();
    }

    public function breadcrumbAdd($title, $path)
    {
        $this->items[] = [
            'title' => $title,
            'path' => $path,
        ];
    }

    public function breadcrumbList()
    {
        return $this->items;
    }

}
