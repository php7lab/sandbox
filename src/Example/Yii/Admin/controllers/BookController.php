<?php

namespace PhpLab\Sandbox\Example\Yii\Admin\controllers;

use yii2rails\domain\data\Query;
use yii2rails\domain\web\ActiveController as Controller;

class BookController extends Controller
{

    const RENDER_INDEX = '@yubundle/example/admin/views/book/index';

    public $formClass = 'yubundle\example\admin\forms\BookForm';
    public $service = 'example.book';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        $actions['view']['render'] = 'view';
        return $actions;
    }

    public function actionIndex()
    {
        $companyId = \App::$domain->account->auth->identity->company_id;
        $query = new Query();
        $query->andWhere(['owner_id' => $companyId]);
        $dataProvider = \App::$domain->example->book->getDataProvider($query);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

}
