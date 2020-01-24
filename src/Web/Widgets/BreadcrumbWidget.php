<?php

namespace PhpLab\Sandbox\Web\Widgets;

use PhpLab\Domain\Data\DataProviderEntity;

class BreadcrumbWidget extends MenuWidget implements WidgetInterface
{

    public $itemOptions = [
        'class' => 'breadcrumb-item',
    ];
    public $wrapTemplate = '<ol class="breadcrumb float-sm-right">{items}</ol>';

    public function __construct(array $items)
    {
        $this->items = $items;
    }

}