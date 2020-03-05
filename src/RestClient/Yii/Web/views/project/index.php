<?php

use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity[] | \Illuminate\Support\Collection $projectCollection
 */

$this->title = 'Project list';

?>

<h2>
    <?= $this->title ?>
</h2>

<?php if($projectCollection->count()) { ?>
    <ul class="list-group">
        <?php foreach ($projectCollection as $projectEntity) { ?>
            <li class="list-group-item list-group-item-action">

                <div class="btn-group pull-right">
                    <a href="<?= Url::to(['/rest-client/project/update', 'id' => $projectEntity->getId()]) ?>" class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="<?= Url::to(['/rest-client/project/delete', 'id' => $projectEntity->getId()]) ?>" class="btn btn-xs btn-danger" data-method="post" data-confirm="<?= Yii::t('bridge', 'Are you sure?') ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>

                <a href="<?= Url::to(['/rest-client/request/send', 'projectName' => $projectEntity->getName()]) ?>">
                    <?= $projectEntity->getTitle() ?>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p class="text-muted">Empty list</p>
<?php } ?>

<a href="<?= Url::to(['/rest-client/project/create']) ?>" class="btn btn-success">Create</a>
