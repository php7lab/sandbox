<?php

namespace PhpLab\Sandbox\Example\Symfony\Api\Controllers;

use PhpLab\Rest\Base\BaseCrudApiController;
use PhpLab\Sandbox\Example\Domain\Interfaces\Services\BookServiceInterface;

class BookController extends BaseCrudApiController
{

    public function __construct(BookServiceInterface $bookService)
    {
        $this->service = $bookService;
    }

}
