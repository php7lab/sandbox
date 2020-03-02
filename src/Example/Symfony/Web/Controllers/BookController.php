<?php

namespace PhpLab\Sandbox\Example\Symfony\Web\Controllers;

use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Domain\Helpers\QueryHelper;
use PhpLab\Core\Domain\Libs\DataProvider;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Rest\Web\Controller\BaseCrudWebController;
use PhpLab\Sandbox\Example\Domain\Interfaces\Services\BookServiceInterface;
use PhpLab\Sandbox\Messenger\Domain\Entities\bookEntity;
use PhpLab\Sandbox\Notify\Domain\Enums\FlashMessageTypeEnum;
use PhpLab\Web\Traits\AccessTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends AbstractController
{

    use AccessTrait;

    private $service;

    public function __construct(BookServiceInterface $bookService)
    {
        $this->service = $bookService;
    }

    public function index(Request $request): Response
    {
        $this->checkAuth();
        $query = QueryHelper::getAllParams($request->query->all());

        $dataProvider = new DataProvider([
            'service' => $this->service,
            'query' => $query,
            'page' => $request->get("page", 1),
            'pageSize' => $request->get("per-page", 10),
        ]);
        return $this->render('@Messenger/book/index.html.twig', [
            'dataProviderEntity' => $dataProvider->getAll(),
        ]);
    }

    public function view($id, Request $request): Response
    {
        $this->checkAuth();
        $query = new Query;
        $query->with('messages');
        $query->with('members');
        /** @var bookEntity $entity */
        $entity = $this->service->oneById($id, $query);
        //dd($entity);
        return $this->render('@Messenger/book/view.html.twig', [
            'book' => $entity,
            'members' => EntityHelper::indexingCollection($entity->getMembers(), 'id'),
        ]);
    }

    public function create(Request $request): Response
    {
        $this->checkAuth();
        return $this->render('@Messenger/book/create.html.twig');
    }

    public function update($id, Request $request): Response
    {
        $this->checkAuth();
        $query = new Query;
        $entity = $this->service->oneById($id, $query);
        return $this->render('@Messenger/book/update.html.twig', [
            'book' => $entity,
        ]);
    }

    public function delete($id, Request $request): Response
    {
        $this->checkAuth();
        $this->service->deleteById($id);
        $bookListUrl = $this->generateUrl('web_reference_book_index');
        $this->addFlash(
            FlashMessageTypeEnum::SUCCESS,
            'book deleted!'
        );
        return $this->redirect($bookListUrl);
    }

}
