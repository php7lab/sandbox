<?php

namespace PhpLab\Sandbox\Article\Api\Controllers;

use PhpLab\Sandbox\Article\Domain\Interfaces\PostServiceInterface;
use PhpLab\Rest\Controllers\BaseCrudApiController;

class ArticleController extends BaseCrudApiController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->service = $postService;
    }

}
