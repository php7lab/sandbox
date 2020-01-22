<?php

namespace PhpLab\Sandbox\AdminPanel;

class MenuWidget extends \PhpLab\Sandbox\Web\Widgets\MenuWidget
{

    public $activateParents = true;

    public function __construct()
    {
        $this->items = include(__DIR__ . '/../../../../../config/admin/menu.php');
    }

}