<?php

/**
 * @var \yii\web\View $this
 * @var \PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity[] $projectCollection
 */

$this->title = 'Project list';

?>

<h2>
    <?= $this->title ?>
</h2>

<div class="list-group">
    <?php foreach ($projectCollection as $projectEntity) { ?>
        <a class="list-group-item list-group-item-action" href="<?= \yii\helpers\Url::to(['/rest-client/request/send', 'projectName' => $projectEntity->getName()]) ?>">
            <?= $projectEntity->getTitle() ?>
        </a>
    <?php } ?>
</div>
