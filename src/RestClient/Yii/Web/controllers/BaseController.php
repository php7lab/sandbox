<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\controllers;

use PhpLab\Core\Exceptions\NotFoundException;
use PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\AuthorizationServiceInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\BookmarkServiceInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\TransportServiceInterface;
use Yii;
use yii\base\Module;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class BaseController extends Controller
{
    protected $bookmarkService;
    protected $projectService;
    protected $transportService;
    protected $authorizationService;

    public function __construct(
        $id, Module $module,
        array $config = [],
        BookmarkServiceInterface $bookmarkService,
        ProjectServiceInterface $projectService,
        TransportServiceInterface $transportService,
        AuthorizationServiceInterface $authorizationService
    )
    {
        parent::__construct($id, $module, $config);
        $this->bookmarkService = $bookmarkService;
        $this->projectService = $projectService;
        $this->transportService = $transportService;
        $this->authorizationService = $authorizationService;
    }

    protected function getProjectByHash(string $tag): ProjectEntity
    {
        $projectName = $this->projectService->projectNameByHash($tag);
        return $this->getProjectByName($projectName);
    }

    protected function getProjectByName(string $projectName): ProjectEntity
    {
        try {
            $projectEntity = $this->projectService->oneByName($projectName);
            $userId = Yii::$app->user->identity->getId();
            $isAllow = $this->projectService->isAllowProject($projectEntity->getId(), $userId);
            if ( ! $isAllow) {
                throw new ForbiddenHttpException('Project not allow!');
            }
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException('Project not found!');
        }
        return $projectEntity;
    }

}