<?php

namespace PhpLab\Sandbox\Bundle\Article\Api\Controller;

use PhpLab\Sandbox\Bundle\Article\Domain\Interfaces\PostServiceInterface;
use PhpLab\Rest\Controller\BaseCrudApiController;

class ArticleController extends BaseCrudApiController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->service = $postService;
    }

}
