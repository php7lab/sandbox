<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\controllers;

use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\BookmarkServiceInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use Yii;
use yii\base\Module;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii2rails\extension\web\helpers\Behavior;
use yii2bundle\navigation\domain\widgets\Alert;

/**
 * Class HistoryController
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class HistoryController extends BaseController
{
    /**
     * @var \PhpLab\Sandbox\RestClient\Yii\Web\Module
     */
    public $module;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verb' => Behavior::verb([
                'delete' => ['post'],
                'clear' => ['post'],
            ]),
        ];
    }

    public function actionDelete($tag)
    {
        $projectEntity = $this->getProjectByHash($tag);
        $this->bookmarkService->removeByHash($tag);
        \App::$domain->navigation->alert->create('Request was removed from history successfully.', Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/request/send', 'projectName' => $projectEntity->getName()]);
    }

    public function actionClear(string $projectName)
    {
        $projectEntity = $this->getProjectByName($projectName);
        $this->bookmarkService->clearHistory($projectEntity->getId());
        \App::$domain->navigation->alert->create('History was cleared successfully.', Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/request/send', 'projectName' => $projectEntity->getName()]);
    }
}