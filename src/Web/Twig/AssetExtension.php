<?php

namespace PhpLab\Sandbox\Web\Twig;

use php7extension\yii\helpers\FileHelper;
use PhpLab\Sandbox\Web\Widgets\PaginationWidget;
use PhpLab\Sandbox\Web\Widgets\WidgetInterface;
use PhpLab\Domain\Data\DataProviderEntity;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{

    private $style = [];
    private $script = [];
    private $types = [
        'css' => 'style',
        'js' => 'script',
    ];
    private $includes = [];

    public function getFunctions()
    {
        return [
            new TwigFunction('style', [$this, 'style'], ['is_safe' => ['html']]),
            new TwigFunction('styleList', [$this, 'styleList'], ['is_safe' => ['html']]),
            new TwigFunction('script', [$this, 'script'], ['is_safe' => ['html']]),
            new TwigFunction('scriptList', [$this, 'scriptList'], ['is_safe' => ['html']]),
            new TwigFunction('resource', [$this, 'includeResource'], ['is_safe' => ['html']]),
        ];
    }

    public function includeResource($path, $attributes = [])
    {
        $urlInfo = parse_url($path);
        $extension = FileHelper::fileExt($urlInfo['path']);
        $type = $this->types[$extension];
        $this->{$type}[] = [
            'path' => $path,
            'attributes' => $attributes,
        ];
    }

    public function script($path, $attributes = [])
    {
        $extension = FileHelper::fileExt($path);
        $type = $this->types[$extension];
        $this->{$type}[] = [
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
