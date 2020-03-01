<?php

namespace PhpLab\Sandbox\Article\Api;

use PhpLab\Rest\Helpers\RestApiControllerHelper;
use PhpLab\Sandbox\Article\Api\Controllers\ArticleController;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\CategoryRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\PostRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\TagPostRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\TagRepository;
use PhpLab\Sandbox\Article\Domain\Services\PostService;
use PhpLab\Eloquent\Db\Helpers\Manager;
use Symfony\Component\HttpFoundation\Request;

class ArticleModule
{

    private $capsule;

    public function __construct() {
        // init DB
        $this->capsule = new Manager(null, $_ENV['ELOQUENT_CONFIG_FILE']);
    }

    public function run() {
        // create service
        $categoryRepository = new CategoryRepository($this->capsule);
        $tagRepository = new TagRepository($this->capsule);
        $tagPostRepository = new TagPostRepository($this->capsule);
        $postRepository = new PostRepository($this->capsule, $categoryRepository, $tagRepository, $tagPostRepository);
        $postService = new PostService($postRepository);

        // define routes
        $routes = RestApiControllerHelper::defineCrudRoutes('v1/article-post', ArticleController::class);
        $request = Request::createFromGlobals();

        $controllers = [
            ArticleController::class => new ArticleController($postService),
        ];
        $response = RestApiControllerHelper::runAll($request, $routes, $controllers);
        $response->send();
    }

}
