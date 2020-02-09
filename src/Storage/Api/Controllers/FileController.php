<?php

namespace PhpLab\Sandbox\Storage\Api\Controllers;

use PhpLab\Rest\Base\BaseCrudApiController;
use PhpLab\Sandbox\Storage\Domain\Interfaces\Services\FileServiceInterface;
use PhpLab\Web\Traits\AccessTrait;

class FileController extends BaseCrudApiController
{

    use AccessTrait;

    public $service = null;

    public function __construct(FileServiceInterface $service)
    {
        $this->service = $service;
    }

}
