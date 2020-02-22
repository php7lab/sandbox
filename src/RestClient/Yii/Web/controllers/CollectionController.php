<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\controllers;

use PhpLab\Core\Exceptions\NotFoundException;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\BookmarkServiceInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use Yii;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii2rails\extension\web\helpers\Behavior;
use yii2bundle\navigation\domain\widgets\Alert;
use yii2bundle\rest\domain\helpers\MiscHelper;
use PhpLab\Sandbox\RestClient\Domain\Helpers\Postman\PostmanHelper;

/**
 * Class CollectionController
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class CollectionController extends BaseController
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
                'link' => ['post'],
                'unlink' => ['post'],
            ]),
        ];
    }

    public function actionLink($tag)
    {
        $projectEntity = $this->getProjectByHash($tag);
        $this->bookmarkService->addToCollection($tag);
        \App::$domain->navigation->alert->create('Request was added to collection successfully.', Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/request/send', 'projectName' => $projectEntity->getName(), 'tag' => $tag]);
    }

    public function actionUnlink($tag)
    {
        $projectEntity = $this->getProjectByHash($tag);
        $this->bookmarkService->removeByHash($tag);
        \App::$domain->navigation->alert->create('Request was removed from collection successfully.', Alert::TYPE_SUCCESS);
        return $this->redirect(['/rest-client/request/send', 'projectName' => $projectEntity->getName()]);
    }
	
	public function actionExportPostman($postmanVersion)
	{
        $collection = $this->bookmarkService->allFavoriteByProject(1);

        $cc = PostmanHelper::splitByGroup($collection);
        $postmanCollection = PostmanHelper::genFromCollection($cc, 'v1');
        $jsonContent = json_encode($postmanCollection, JSON_PRETTY_PRINT);

        $apiVersion = MiscHelper::currentApiVersion();
        $collectionName = MiscHelper::collectionNameFormatId();
        $fileName = $collectionName .'-' . date('Y-m-d-H-i-s') . '.json';

        return Yii::$app->response->sendContentAsFile(
            $jsonContent,
            $fileName
        );
	}
	
}