<?php

namespace PhpLab\Sandbox\Article\Api;

use PhpLab\Sandbox\Article\Api\Controllers\ArticleController;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\CategoryRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\PostRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\TagPostRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\TagRepository;
use PhpLab\Sandbox\Article\Domain\Services\PostService;
use PhpLab\Eloquent\Db\Helpers\Manager;
use Symfony\Component\HttpFoundation\Request;
use PhpLab\Rest\Helpers\RestHelper;

class ArticleModule extends BaseCrudApiController
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
        $routes = RestHelper::defineCrudRoutes('v1/article', ArticleController::class);
        $request = Request::createFromGlobals();

        $controllers = [
            ArticleController::class => new ArticleController($postService),
        ];
        $response = RestHelper::runAll($request, $routes, $controllers);
        $response->send();
    }

}
