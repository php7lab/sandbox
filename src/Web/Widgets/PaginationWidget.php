<?php

namespace PhpLab\Sandbox\Web\Widgets;

use PhpLab\Domain\Data\DataProviderEntity;

class PaginationWidget extends BaseWidget implements WidgetInterface
{

    private $dataProviderEntity;
    private $perPageArray = [10, 20, 50];

    public function __construct(DataProviderEntity $dataProviderEntity)
    {
        $this->dataProviderEntity = $dataProviderEntity;
    }

    public function render(): string
    {
        if($this->dataProviderEntity->getPageCount() == 1) {
            return '';
        }
        $itemsHtml = '';
        $itemsHtml .= $this->renderPrevItem();
        for ($page = 1; $page <= $this->dataProviderEntity->getPageCount(); $page++) {
            $itemsHtml .= $this->renderPageItem($page);
        }
        $itemsHtml .= $this->renderNextItem();
        $renderPageSizeSelector = $this->renderPageSizeSelector();
        $itemsHtml .= $renderPageSizeSelector ? '<li class="page-item">' . $renderPageSizeSelector . '</li>' : '';
        return $this->renderLayout($itemsHtml)/* . ($renderPageSizeSelector ? '' . $renderPageSizeSelector . '' : '')*/;
    }

    private function renderLayout(string $items) {
        return "
            <nav aria-label=\"Page navigation\">
                <ul class=\"pagination justify-content-end\">
                    {$items}
                </ul>
            </nav>
        ";
    }

    private function renderPageSizeSelector() {
        if(empty($this->perPageArray)) {
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

    private function renderPageItem(int $page) {
        $selectedClass = ($this->dataProviderEntity->page == $page) ? 'active' : '';
        return "
            <li class=\"page-item {$selectedClass}\">
                <a class=\"page-link\" href=\"?page={$page}\">
                    {$page}
                </a>
            </li>
        ";
    }

    private function renderPrevItem() {
        $prevClass = $this->dataProviderEntity->isFirstPage() ? 'disabled' : '';
        return "
            <li class=\"page-item {$prevClass}\">
                <a class=\"page-link\" href=\"?page={$this->dataProviderEntity->getPrevPage()}\" aria-label=\"Previous\">
                    <span aria-hidden=\"true\">&laquo;</span>
                </a>
            </li>
        ";
    }

    private function renderNextItem() {
        $nextClass = $this->dataProviderEntity->isLastPage() ? 'disabled' : '';
        return "
            <li class=\"page-item {$nextClass}\">
                <a class=\"page-link\" href=\"?page={$this->dataProviderEntity->getNextPage()}\" aria-label=\"Next\">
                    <span aria-hidden=\"true\">&raquo;</span>
                </a>
            </li>
        ";
    }

}