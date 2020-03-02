<?php

namespace PhpLab\Sandbox\Article\Symfony\Api\Controllers;

use PhpLab\Rest\Base\BaseCrudApiController;
use PhpLab\Sandbox\Article\Domain\Interfaces\PostServiceInterface;

class ArticleController extends BaseCrudApiController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->service = $postService;
    }

}
