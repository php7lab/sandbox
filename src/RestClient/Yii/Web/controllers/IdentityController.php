<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\controllers;

use kartik\alert\Alert;
use Packages\User\Domain\Interfaces\Services\IdentityServiceInterface;
use PhpLab\Core\Domain\Exceptions\UnprocessibleEntityException;
use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Libs\I18Next\Facades\I18Next;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\AccessServiceInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use PhpLab\Sandbox\RestClient\Yii\Web\models\IdentityForm;
use Yii;
use yii\base\Module;
use yii\web\Controller;

class IdentityController extends Controller
{

    private $projectService;
    private $identityService;
    private $accessService;

    public function __construct(
        $id,
        Module $module,
        array $config = [],
        ProjectServiceInterface $projectService,
        IdentityServiceInterface $identityService,
        AccessServiceInterface $accessService
    )
    {
        parent::__construct(
            $id,
            $module,
            $config
        );
        $this->projectService = $projectService;
        $this->identityService = $identityService;
        $this->accessService = $accessService;
    }

    public function actionIndex()
    {
        /*if(Yii::$app->user->can(PermissionEnum::BACKEND_ALL)) {
            $identityCollection = $this->identityService->all();
        } else {
            $identityCollection = $this->identityService->allByUserId(Yii::$app->user->identity->id);
        }*/
        $identityCollection = $this->identityService->all();
        return $this->render('index', [
            'identityCollection' => $identityCollection,
        ]);
    }

    public function actionCreate()
    {
        $model = new IdentityForm;
        if (Yii::$app->request->isPost) {
            $body = Yii::$app->request->post();
            $model->load($body, 'IdentityForm');
            $this->identityService->create($model->toArray());
            \App::$domain->navigation->alert->create(I18Next::t('restclient', 'identity.messages.created_success'), Alert::TYPE_SUCCESS);
            return $this->redirect(['/rest-client/identity/index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->identityService->deleteById($id);
        \App::$domain->navigation->alert->create(I18Next::t('restclient', 'identity.messages.deleted_success'), Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/identity/index']);
    }

    public function actionUpdate($id)
    {
        $model = new IdentityForm;
        if (Yii::$app->request->isPost) {
            $body = Yii::$app->request->post();
            $model->load($body, 'IdentityForm');
            $this->identityService->updateById($id, $model->toArray());
            \App::$domain->navigation->alert->create(I18Next::t('restclient', 'identity.messages.updated_success'), Alert::TYPE_SUCCESS);
            return $this->redirect(['/rest-client/identity/index']);
        } else {
            $identityEntity = $this->identityService->oneById($id);
            $model->load(EntityHelper::toArray($identityEntity), '');
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $identityEntity = $this->identityService->oneById($id);
        $projectCollection = $this->projectService->allWithoutUserId($id);
        $hasProjectCollection = $this->projectService->allByUserId($id);
        return $this->render('view', [
            'identityEntity' => $identityEntity,
            'projectCollection' => $projectCollection,
            'hasProjectCollection' => $hasProjectCollection,
        ]);
    }

    public function actionAttach($projectId, $userId)
    {
        $this->accessService->attach($projectId, $userId);
        \App::$domain->navigation->alert->create(I18Next::t('restclient', 'access.messages.created_success'), Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/identity/view', 'id' => $userId]);
    }

    public function actionDetach($projectId, $userId)
    {
        $this->accessService->detach($projectId, $userId);
        \App::$domain->navigation->alert->create(I18Next::t('restclient', 'access.messages.deleted_success'), Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/identity/view', 'id' => $userId]);
    }
}