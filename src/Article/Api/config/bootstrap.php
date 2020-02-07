<?php

use PhpLab\Sandbox\Article\Api\Controllers\ArticleController;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\CategoryRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\PostRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\TagPostRepository;
use PhpLab\Sandbox\Article\Domain\Repositories\Eloquent\TagRepository;
use PhpLab\Sandbox\Article\Domain\Services\PostService;
use PhpLab\Eloquent\Db\Helpers\Manager;
use Symfony\Component\HttpFoundation\Request;
use PhpLab\Rest\Helpers\RestHelper;

// init DB
$capsule = new Manager(null, $_ENV['ELOQUENT_CONFIG_FILE']);

// create service
$categoryRepository = new CategoryRepository($capsule);
$tagRepository = new TagRepository($capsule);
$tagPostRepository = new TagPostRepository($capsule);
$postRepository = new PostRepository($capsule, $categoryRepository, $tagRepository, $tagPostRepository);
$postService = new PostService($postRepository);

// define routes
$routes = RestHelper::defineCrudRoutes('v1/article', ArticleController::class);
$request = Request::createFromGlobals();

$controllers = [
    ArticleController::class => new ArticleController($postService),
];
$response = RestHelper::runAll($request, $routes, $controllers);
$response->send();
