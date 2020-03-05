<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 */

$this->title = 'Update project';

?>

<h2>
    <?= $this->title ?>
</h2>

<div class="row">
    <div class="col-lg-5">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
