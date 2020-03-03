<?php

namespace PhpLab\Sandbox\Example\Yii\Api\controllers;

use PhpLab\Sandbox\Example\Domain\Enums\ExampleBookPermissionEnum;
use PhpLab\Sandbox\Example\Domain\Interfaces\Services\BookServiceInterface;
use RocketLab\Bundle\Rest\Base\BaseCrudController;
use yii\base\Module;

class BookController extends BaseCrudController
{

    public function __construct(
        string $id,
        Module $module,
        array $config = [],
        BookServiceInterface $bookService
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $bookService;
    }

    public function access(): array
    {
        return [
            [
                [ExampleBookPermissionEnum::WRITE], ['create', 'update', 'delete']
            ],
        ];
    }

    public function authentication(): array
    {
        return [
            'create',
            'update',
            'delete',
        ];
    }

}
