<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\controllers;

use common\enums\rbac\PermissionEnum;
use kartik\alert\Alert;
use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Libs\I18Next\Facades\I18Next;
use PhpLab\Sandbox\RestClient\Yii\Web\models\ProjectForm;
use Yii;

class ProjectController extends BaseController
{
    public function actionIndex()
    {
        if(Yii::$app->user->can(PermissionEnum::BACKEND_ALL)) {
            $projectCollection = $this->projectService->all();
        } else {
            $projectCollection = $this->projectService->allByUserId(Yii::$app->user->identity->id);
        }
        return $this->render('index', [
            'projectCollection' => $projectCollection,
        ]);
    }

    public function actionCreate()
    {
        $model = new ProjectForm;
        if(Yii::$app->request->isPost) {
            $body = Yii::$app->request->post();
            $model->load($body, 'ProjectForm');
            $this->projectService->create($model->toArray());
            \App::$domain->navigation->alert->create(I18Next::t('restclient', 'project.messages.created_success'), Alert::TYPE_SUCCESS);
            return $this->redirect(['/rest-client/project/index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $this->projectService->deleteById($id);
        \App::$domain->navigation->alert->create(I18Next::t('restclient', 'project.messages.deleted_success'), Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/project/index']);
    }

    public function actionUpdate($id) {
        $model = new ProjectForm;
        if(Yii::$app->request->isPost) {
            $body = Yii::$app->request->post();
            $model->load($body, 'ProjectForm');
            $this->projectService->updateById($id, $model->toArray());
            \App::$domain->navigation->alert->create(I18Next::t('restclient', 'project.messages.updated_success'), Alert::TYPE_SUCCESS);
            return $this->redirect(['/rest-client/project/index']);
        } else {
            $projectEntity = $this->projectService->oneById($id);
            $model->load(EntityHelper::toArray($projectEntity), '');
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}