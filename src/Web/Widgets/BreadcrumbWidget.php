<?php

namespace PhpLab\Sandbox\Web\Widgets;

use PhpLab\Domain\Data\DataProviderEntity;

class BreadcrumbWidget extends BaseWidget implements WidgetInterface
{

    private $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function render(): string
    {
        if($this->items == []) {
            return '';
        }
        $itemsHtml = '';
        foreach ($this->items as $item) {
            $itemsHtml .= $this->renderItem($item);
        }
        return $this->renderLayout($itemsHtml);
    }

    private function renderLayout(string $itemsHtml) {
        return "
            <ol class=\"breadcrumb\">
                {$itemsHtml}
            </ol>
        ";
    }

    private function renderItem(array $item) {
        return "
            <li>
                <a href=\"?page={$item['path']}\">
                    {$item['title']}
                </a>
            </li>
        ";
    }

}