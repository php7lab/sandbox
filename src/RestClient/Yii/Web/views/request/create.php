<?php

/**
 * @var \yii\web\View $this
 * @var string $tag
 * @var string $frame
 * @var \PhpLab\Sandbox\RestClient\Yii\Web\models\RequestForm $model
 * @var \PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity $projectEntity
 * @var \Symfony\Component\HttpFoundation\Response $response
 */

if ($model->method) {
    $this->title = strtoupper($model->method) . ' ' . $model->endpoint;
} else {
    $this->title = 'New Request';
}
?>

<div class="rest-request-create">
    <div class="row">
        <div class="col-lg-8">
            <div class="rest-request-form">
                <?= \PhpLab\Sandbox\RestClient\Yii\Web\Widgets\FormWidget::widget([
                    'projectId' => $projectEntity->getId(),
                    'model' => $model,
                ]) ?>
            </div>
            <? if ($response) { ?>
                <div id="response" class="rest-request-response">
                    <?= $this->render('_response', [
                        'duration' => $duration,
                        'response' => $response,
                        'frame' => $frame,
                    ]) ?>
                </div>
            <? } ?>
        </div>
        <div class="col-lg-4">
            <?= \PhpLab\Sandbox\RestClient\Yii\Web\Widgets\CollectionWidget::widget([
                'projectId' => $projectEntity->getId(),
                'tag' => $tag,
            ]) ?>
        </div>
    </div>
</div>

<?= $this->render('assets'); ?>
