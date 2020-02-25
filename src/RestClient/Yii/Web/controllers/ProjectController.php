<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\controllers;

use PhpLab\Core\Enums\Http\HttpHeaderEnum;
use PhpLab\Core\Helpers\UploadHelper;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;
use PhpLab\Sandbox\RestClient\Yii\Web\helpers\AdapterHelper;
use PhpLab\Sandbox\RestClient\Yii\Web\models\RequestForm;
use PhpLab\Test\Helpers\RestHelper;
use Yii;

/**
 * Class RequestController
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class ProjectController extends BaseController
{
    /**
     * @var \PhpLab\Sandbox\RestClient\Yii\Web\Module
     */
    public $module;
    /**
     * @inheritdoc
     */
    public $defaultAction = 'create';

    public function actionIndex()
    {
        $projectCollection = $this->projectService->all();



        //dd($projectCollection->whereIn(''));
        return $this->render('index', [
            'projectCollection' => $projectCollection,
        ]);
    }

}