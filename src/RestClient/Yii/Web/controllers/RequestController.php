<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\controllers;

use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Enums\Http\HttpHeaderEnum;
use PhpLab\Core\Helpers\UploadHelper;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;
use PhpLab\Test\Helpers\RestHelper;
use Yii;
use yii2rails\extension\yii\helpers\ArrayHelper;
use PhpLab\Sandbox\RestClient\Yii\Web\helpers\AdapterHelper;
use PhpLab\Sandbox\RestClient\Yii\Web\helpers\CollectionHelper;
use PhpLab\Sandbox\RestClient\Yii\Web\models\RequestForm;

/**
 * Class RequestController
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class RequestController extends BaseController
{
    /**
     * @var \PhpLab\Sandbox\RestClient\Yii\Web\Module
     */
    public $module;
    /**
     * @inheritdoc
     */
    public $defaultAction = 'create';

    public function actionSend(string $projectName, $tag = null)
    {
        /** @var RequestForm $model */
        $model = Yii::createObject(RequestForm::class);
        $projectEntity = $this->getProjectByName($projectName);
        $response = null;
        $duration = null;
        if ($tag !== null) {
            /** @var BookmarkEntity $bookmarkEntity */
            $bookmarkEntity = $this->bookmarkService->oneByHash($tag);
            $model = AdapterHelper::bookmarkEntityToForm($bookmarkEntity);
        } elseif (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate()) {


                $model->files = UploadHelper::createUploadedFileArray($_FILES);

                $begin = microtime(true);
                $response = $this->transportService->send($projectEntity, $model);
                $duration = microtime(true) - $begin;

                $bookmarkEntity = AdapterHelper::formToBookmarkEntityData($model);
                $bookmarkEntity->setProjectId($projectEntity->getId());
                $this->bookmarkService->persist($bookmarkEntity);
                $tag = $bookmarkEntity->getHash();

                $contentDisposition = RestHelper::extractHeaderValues($response, HttpHeaderEnum::CONTENT_DISPOSITION);
                //$contentDisposition = $response->getHeader('Content-Disposition')[0] ?? null;

                if ($contentDisposition != null) {
                    //$ee = explode(';', $contentDisposition);
                    if ($contentDisposition[0] == 'attachment') {
                        Yii::$app->response->headers->fromArray($response->getHeaders());
                        return $response->getBody()->getContents();
                    } /*elseif($ee[0] == 'inline') {
			    $requestEntity = AdapterHelper::createRequestEntityFromForm($model);
			    $requestEntity->headers['Authorization'] = ;
			    //prr($requestEntity,1,1);
			    $frame = $this->module->baseUrl . SL . $requestEntity->uri;
		    }*/
                }
            }
        }

        $history = $this->bookmarkService->allHistoryByProject($projectEntity->getId());
        $collection = $this->bookmarkService->allFavoriteByProject($projectEntity->getId());

        $frame = null;

        return $this->render('create', [
            'tag' => $tag,
            'model' => $model,
            'response' => $response,
            'frame' => $frame,
            'history' => $history,
            'collection' => $collection,
            'projectEntity' => $projectEntity,
            'duration' => $duration,
            'authorization' => $this->authorizationService->allByProjectId($projectEntity->getId(), 'bearer'),
        ]);
    }

}