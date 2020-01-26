<?php

namespace PhpLab\Sandbox\Html\Widgets;

use PhpLab\Domain\Data\DataProviderEntity;
use PhpLab\Sandbox\Html\Base\BaseWidget;

class PaginationWidget extends BaseWidget
{

    private $dataProviderEntity;
    private $perPageArray = [10, 20, 50];

    public function __construct(DataProviderEntity $dataProviderEntity)
    {
        $this->dataProviderEntity = $dataProviderEntity;
    }

    public function render(): string
    {
        if ($this->dataProviderEntity->getPageCount() == 1) {
            return '';
        }
        $itemsHtml = $this->renderItems();
        $renderPageSizeSelector = $this->renderPageSizeSelector();
        $itemsHtml .= $renderPageSizeSelector ? '<li class="page-item">' . $renderPageSizeSelector . '</li>' : '';
        return $this->renderLayout($itemsHtml);
    }


    private function renderItems()
    {
        $items = [];
        $items[] = [
            'label' => '&laquo;',
            'url' => '?page=' . $this->dataProviderEntity->getPrevPage(),
            'encode' => false,
            'options' => ['class' => ($this->dataProviderEntity->isFirstPage() ? 'page-item disabled' : 'page-item')],
        ];

        for ($page = 1; $page <= $this->dataProviderEntity->getPageCount(); $page++) {
            $items[] = [
                'label' => $page,
                'url' => '?page=' . $page,
                'active' => ($this->dataProviderEntity->page == $page) ? 'active' : '',
            ];
        }

        $items[] = [
            'label' => '&raquo;',
            'url' => '?page=' . $this->dataProviderEntity->getNextPage(),
            'encode' => false,
            'options' => ['class' => ($this->dataProviderEntity->isLastPage() ? 'page-item disabled' : 'page-item')],
        ];

        $menuWidget = new MenuWidget;
        $menuWidget->items = $items;
        $menuWidget->itemOptions = [
            'class' => 'page-item',
        ];
        $menuWidget->linkTemplate = '<a href="{url}" class="page-link {class}">{label}</a>';
        $itemsHtml = $menuWidget->render();
        return $itemsHtml;
    }

    private function renderLayout(string $items)
    {
        return "
            <nav aria-label=\"Page navigation\">
                <ul class=\"pagination justify-content-end\">
                    {$items}
                </ul>
            </nav>
        ";
    }

    private function renderPageSizeSelector()
    {
        if (empty($this->perPageArray)) {
            return '';
        }
        $html = '';
        foreach ($this->perPageArray as $size) {
            $html .= "<a class=\"dropdown-item\" href='?per-page={$size}'>{$size}</a>";
        }
        return "
            <li class=\"page-item \">
                <a class=\"page-link dropdown-toggle\" href=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    {$this->dataProviderEntity->getPageSize()}
                </a>
                <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"navbarDropdown\">
                    <h6 class=\"dropdown-header\">Page size</h6>
                    {$html}
                </div>
            </li>";
    }

}