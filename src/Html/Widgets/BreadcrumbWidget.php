<?php

namespace PhpLab\Sandbox\Html\Widgets;

use PhpLab\Domain\Data\DataProviderEntity;

class BreadcrumbWidget extends MenuWidget implements WidgetInterface
{

    public $itemOptions = [
        'class' => 'breadcrumb-item',
    ];
    public $linkTemplate = '<a href="{url}" class="{class}">{icon}{label}{treeViewIcon}{badge}</a>';
    public $wrapTemplate = '<ol class="breadcrumb">{items}</ol>';
    public $encodeLabels = false;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

}