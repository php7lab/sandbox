<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\controllers;

use yii2bundle\navigation\domain\widgets\Alert;
use yii2rails\extension\web\helpers\Behavior;

/**
 * Class HistoryController
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class HistoryController extends BaseController
{

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