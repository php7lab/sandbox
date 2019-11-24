<?php

namespace PhpLab\Sandbox\Messenger\Web\Controllers;

use php7rails\domain\data\GetParams;
use php7rails\domain\data\Query;
use PhpLab\Sandbox\Article\Domain\Interfaces\PostServiceInterface;
use PhpLab\Domain\Data\DataProvider;
use PhpLab\Rest\Web\Controller\BaseCrudWebController;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Sandbox\Notify\Enums\FlashMessageTypeEnum;
use PhpLab\Sandbox\Web\Traits\AccessTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends AbstractController
{

    use AccessTrait;

    private $service;

    public function __construct(ChatServiceInterface $chatService)
    {
        $this->service = $chatService;
    }

    public function index(Request $request) : Response
    {
        $this->checkAuth();
        $getParams = new GetParams;
        $query = $getParams->getAllParams($request->query->all());
        //$query->with('category');

        $dataProvider = new DataProvider([
            'service' => $this->service,
            'query' => $query,
            'page' => $request->get("page", 1),
            'pageSize' => $request->get("per-page", 10),
        ]);
        return $this->render('@Messenger/chat/index.html.twig', [
            'dataProviderEntity' => $dataProvider->getAll(),
        ]);
    }

    public function view($id, Request $request) : Response
    {
        $this->checkAuth();
        $query = new Query;
        //$query->with('category');
        $entity = $this->service->oneById($id, $query);
        return $this->render('@Messenger/chat/view.html.twig', [
            'chat' => $entity,
        ]);
    }

    public function create(Request $request) : Response
    {
        $this->checkAuth();
        return $this->render('@Messenger/chat/create.html.twig');
    }

    public function update($id, Request $request) : Response
    {
        $this->checkAuth();
        $query = new Query;
        //$query->with('category');
        $entity = $this->service->oneById($id, $query);
        return $this->render('@Messenger/chat/update.html.twig', [
            'chat' => $entity,
        ]);
    }

    public function delete($id, Request $request) : Response
    {
        $this->checkAuth();
        $this->service->deleteById($id);
        $chatListUrl = $this->generateUrl('web_messenger_chat_index');
        $this->addFlash(
            FlashMessageTypeEnum::SUCCESS,
            'Chat deleted!'
        );
        return $this->redirect($chatListUrl);
    }

}