<?php

namespace PhpLab\Sandbox\Article\Web\Controller;

use php7rails\domain\data\GetParams;
use php7rails\domain\data\Query;
use PhpLab\Sandbox\Article\Domain\Interfaces\PostServiceInterface;
use PhpLab\Domain\Data\DataProvider;
use PhpLab\Rest\Web\Controller\BaseCrudWebController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{

    private $service;

    public function __construct(PostServiceInterface $postService)
    {
        $this->service = $postService;
    }

    public function index(Request $request) : Response
    {
        $getParams = new GetParams;
        $query = $getParams->getAllParams($request->query->all());
        $query->with('category');

        $dataProvider = new DataProvider([
            'service' => $this->service,
            'query' => $query,
            'page' => $request->get("page", 1),
            'pageSize' => $request->get("per-page", 10),
        ]);
        return $this->render('@Article/post/index.html.twig', [
            'dataProviderEntity' => $dataProvider->getAll(),
        ]);
    }

    public function view($id, Request $request) : Response
    {
        $query = new Query;
        $query->with('category');
        $entity = $this->service->oneById($id, $query);
        return $this->render('@Article/post/view.html.twig', [
            'post' => $entity,
        ]);
    }

    public function create(Request $request) : Response
    {
        return $this->render('@Article/post/create.html.twig');
    }

    public function update($id, Request $request) : Response
    {
        $query = new Query;
        $query->with('category');
        $entity = $this->service->oneById($id, $query);
        return $this->render('@Article/post/update.html.twig', [
            'post' => $entity,
        ]);
    }

    public function delete($id, Request $request) : Response
    {
        $this->service->deleteById($id);
        $postListUrl = $this->generateUrl('web_article_post_index');
        return $this->redirect($postListUrl);
    }

}
