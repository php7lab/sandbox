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
use yii2bundle\account\domain\v3\enums\AccountPermissionEnum;
use yii2rails\domain\base\Model;
use yii2rails\domain\exceptions\UnprocessableEntityHttpException;

class IdentityController extends BaseController
{

    protected $projectService;
    protected $identityService;
    protected $accessService;

    public function __construct(
        $id, Module $module,
        array $config = [],
        ProjectServiceInterface $projectService,
        IdentityServiceInterface $identityService,
        AccessServiceInterface $accessService
    )
    {
        parent::__construct($id, $module, $config);
        $this->projectService = $projectService;
        $this->identityService = $identityService;
        $this->accessService = $accessService;
    }

    public function authentication(): array
    {
        return [
            'create',
            'update',
            'delete',
            'index',
            'view',
        ];
    }

    public function access(): array
    {
        return [
            [
                [AccountPermissionEnum::IDENTITY_READ], ['create', 'update', 'delete'],
            ],
            [
                [AccountPermissionEnum::IDENTITY_WRITE], ['index', 'view'],
            ],
        ];
    }

    /*public function __construct(
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
    }*/

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

    public function addErrorsFromException(UnprocessableEntityHttpException $e, $model) {
        $errors = $e->getErrors();
        if($errors instanceof Model) {
            $errors = $errors->getErrors();
        }
        foreach($errors as $field => $error) {
            $model->addError($field, $error);
        }
    }

    public function actionCreate()
    {
        $model = new IdentityForm;
        if (Yii::$app->request->isPost) {
            $body = Yii::$app->request->post();
            $model->load($body, 'IdentityForm');
            try {
                \App::$domain->account->identity->create($model->toArray());
            } catch (UnprocessableEntityHttpException $e) {
                $this->addErrorsFromException($e, $model);
            }
            \App::$domain->navigation->alert->create(I18Next::t('restclient', 'identity.messages.created_success'), Alert::TYPE_SUCCESS);
            return $this->redirect(['/rest-client/identity/index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        \App::$domain->account->identity->deleteById($id);
        \App::$domain->navigation->alert->create(I18Next::t('restclient', 'identity.messages.deleted_success'), Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/identity/index']);
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