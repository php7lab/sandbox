<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use PhpLab\Sandbox\RestClient\Yii\Web\models\RequestForm;
use PhpLab\Sandbox\RestClient\Yii\Web\helpers\Authorization;

/**
 * @var \yii\web\View $this
 * @var string $baseUrl
 * @var RequestForm $model
 * @var ActiveForm $form
 * @var \PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity $projectEntity
 */

$baseUrl = $projectEntity->getUrl() . '/';
$model->addEmptyRows();
?>

<?php $form = ActiveForm::begin([
    'action' => \yii\helpers\Url::to(['/rest-client/request/send', 'projectName' => $projectEntity->getName()]),
    'fieldConfig' => [
        'labelOptions' => ['class' => 'control-label sr-only'],
    ],
    'enableClientValidation' => false,
    'options' => ['enctype' => 'multipart/form-data'],
]) ?>
<?= $form->field($model, 'tab', [
    'template' => '{input}',
    'options' => ['class' => ''],
])->hiddenInput() ?>

    <div class="row">
        <div class="col-sm-2">

            <?= $form->field($model, 'method', [
                'options' => ['class' => 'form-group'],
            ])->dropDownList(RequestForm::methodLabels()) ?>

        </div>
        <div class="col-sm-10">

            <?= $form->field($model, 'endpoint', [
                'template' => <<<HTML
                        {label}
                        <div class="input-group">
                            <div class="input-group-addon">$baseUrl</div>
                            {input}
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" tabindex="-1">Send</button>
                            </span>
                        </div>
                        {hint}
                        {error}
HTML
                ,
                'options' => ['class' => 'form-group'],
            ])->textInput([
                'placeholder' => 'endpoint',
                'autofocus' => true,
            ]) ?>

        </div>
    </div>

<?php if ($model->description): ?>
    <div class="description-text">
        <?= $model->description ?>
    </div>
<?php endif; ?>

    <ul class="nav nav-tabs">
        <?php
        $queryCount = count($model->queryKeys) - 1;
        $bodyCount = count($model->bodyKeys) - 1;
        $fileCount = 0; // count($model->fileKeys) - 1;
        $headersCount = count($model->headerKeys) - 1;
        ?>
        <li class="<?= $model->tab == 1 ? 'active' : '' ?>">
            <a href="#request-query" data-toggle="tab" tabindex="-1">
                Query
                <?= Html::tag('span', $queryCount, [
                    'class' => 'badge badge-default' . (! $queryCount ? ' hidden' : '')
                ]) ?>
            </a>
        </li>
        <li class="<?= $model->tab == 2 ? 'active' : '' ?>">
            <a href="#request-body" data-toggle="tab" tabindex="-1">
                Body
                <?= Html::tag('span', $bodyCount, [
                    'class' => 'badge badge-default' . (! $bodyCount ? ' hidden' : '')
                ]) ?>
            </a>
        </li>
        <li class="<?= $model->tab == 66 ? 'active' : '' ?>">
            <a href="#request-file" data-toggle="tab" tabindex="-1">
                File
                <?= Html::tag('span', $fileCount, [
                    'class' => 'badge badge-default' . (! $fileCount ? ' hidden' : '')
                ]) ?>
            </a>
        </li>
        <li class="<?= $model->tab == 3 ? 'active' : '' ?>">
            <a href="#request-headers" data-toggle="tab" tabindex="-1">
                Headers
                <?= Html::tag('span', $headersCount, [
                    'class' => 'badge badge-default' . (! $headersCount ? ' hidden' : '')
                ]) ?>
            </a>
        </li>
        <li class="<?= $model->tab == 4 ? 'active' : '' ?>">
            <a href="#request-authorization" data-toggle="tab" tabindex="-1">
                Authorization
            </a>
        </li>
        <li class="<?= $model->tab == 5 ? 'active' : '' ?>">
            <a href="#request-description" data-toggle="tab" tabindex="-1">
                Description
            </a>
        </li>
    </ul>

    <div class="tab-content">

        <div id="request-query" class="tab-pane <?= $model->tab == 1 ? 'active' : '' ?>">
            <?= $this->render('_params', [
                'model' => $model,
                'form' => $form,
                'keyAttribute' => 'queryKeys',
                'valueAttribute' => 'queryValues',
                'activeAttribute' => 'queryActives',
            ]) ?>
        </div><!-- #request-params -->

        <div id="request-body" class="tab-pane <?= $model->tab == 2 ? 'active' : '' ?>">
            <?= $this->render('_params', [
                'model' => $model,
                'form' => $form,
                'keyAttribute' => 'bodyKeys',
                'valueAttribute' => 'bodyValues',
                'activeAttribute' => 'bodyActives',
            ]) ?>
        </div><!-- #request-body -->

        <div id="request-file" class="tab-pane <?= $model->tab == 66 ? 'active' : '' ?>">
            <?= $this->render('_files', [
                'model' => $model,
                'form' => $form,
                /*'keyAttribute' => 'fileKeys',
                'valueAttribute' => 'fileValues',
                'activeAttribute' => 'fileActives',*/
            ]) ?>
        </div><!-- #request-file -->

        <div id="request-headers" class="tab-pane <?= $model->tab == 3 ? 'active' : '' ?>">
            <?= $this->render('_params', [
                'model' => $model,
                'form' => $form,
                'keyAttribute' => 'headerKeys',
                'valueAttribute' => 'headerValues',
                'activeAttribute' => 'headerActives',
            ]) ?>
        </div><!-- #request-headers -->

        <div id="request-authorization" class="tab-pane <?= $model->tab == 4 ? 'active' : '' ?>">
            <?= $form->field($model, 'authorization')->dropDownList(Authorization::collectionToOptions($authorization)); ?>
        </div><!-- #request-authorization -->

        <div id="request-description" class="tab-pane <?= $model->tab == 5 ? 'active' : '' ?>">
            <?= $form->field($model, 'description', [
                'options' => [
                    'class' => 'form-group',
                ],
            ])->textarea([
                'placeholder' => 'This is description of the request. It show in collection and history.',
                'rows' => 1,
            ]) ?>
        </div><!-- #request-description -->

    </div>

<?php ActiveForm::end() ?>
