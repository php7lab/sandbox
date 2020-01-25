<?php

namespace PhpLab\Sandbox\Html\Twig;

use PhpLab\Domain\Data\DataProviderEntity;
use PhpLab\Sandbox\Html\Widgets\ModalWidget;
use PhpLab\Sandbox\Html\Widgets\PaginationWidget;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PaginationExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('pagination', [$this, 'pagination'], ['is_safe' => ['html']]),
        ];
    }

    public function pagination(DataProviderEntity $dataProviderEntity)
    {
        $widgetInstance = new PaginationWidget($dataProviderEntity);
        return $widgetInstance->render();
    }

}
