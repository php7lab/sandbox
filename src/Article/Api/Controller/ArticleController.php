<?php

namespace PhpLab\Sandbox\Article\Api\Controller;

use PhpLab\Sandbox\Article\Domain\Interfaces\PostServiceInterface;
use PhpLab\Rest\Controller\BaseCrudApiController;

class ArticleController extends BaseCrudApiController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->service = $postService;
    }

}
