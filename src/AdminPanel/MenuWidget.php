<?php

namespace PhpLab\Sandbox\AdminPanel;

class MenuWidget extends \PhpLab\Sandbox\Web\Widgets\MenuWidget
{

    public $itemOptions = [
        'class' => 'nav-item',
    ];
    public $linkTemplate =
        '<a href="{url}" class="nav-link {class}">
            {icon}
            <p>
                {label}
                {treeViewIcon}
                {badge}
            </p>
        </a>';
    public $submenuTemplate = '<ul class="nav nav-treeview">{items}</ul>';
    public $activateParents = true;
    public $treeViewIcon = '<i class="right fas fa-angle-left"></i>';

    public function __construct()
    {
        $this->items = include(__DIR__ . '/../../../../../config/admin/menu.php');
    }

}