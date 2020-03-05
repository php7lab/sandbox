<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \PhpLab\Sandbox\RestClient\Yii\Web\models\ProjectForm $model
 */

?>

<?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'title')->textInput() ?>
        <?= $form->field($model, 'url')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
