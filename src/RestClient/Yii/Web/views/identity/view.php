<?php

use PhpLab\Core\Libs\I18Next\Facades\I18Next;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \Packages\User\Domain\Entities\IdentityEntity $identityEntity
 * @var \PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity[] | \Illuminate\Support\Collection $projectCollection
 * @var \PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity[] | \Illuminate\Support\Collection $hasProjectCollection
 */

$this->title = $identityEntity->getLogin();

?>

<h2>
    <?= $this->title ?>
</h2>

<div class="row">
    <div class="col-lg-5">
        <?= $identityEntity->getLogin() ?>
    </div>
</div>

<h3>
    <?= I18Next::t('restclient', 'project.list_title') ?>
</h3>

<?php if($projectCollection->count()) { ?>
    <ul class="list-group">
        <?php foreach ($projectCollection as $projectEntity) { ?>
            <li class="list-group-item list-group-item-action">
                <div class="btn-group pull-right">
                    <a href="<?= Url::to(['/rest-client/identity/attach', 'projectId' => $projectEntity->getId(), 'userId' => $identityEntity->getId()]) ?>"
                       class="btn btn-xs btn-info">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <a href="<?= Url::to(['/rest-client/identity/view', 'projectId' => $projectEntity->getId(), 'userId' => $identityEntity->getId()]) ?>">
                    <?= $projectEntity->getTitle() ?>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p class="text-muted">Empty list</p>
<?php } ?>

<h3>
    <?= I18Next::t('restclient', 'project.has_list_title') ?>
</h3>

<?php if($hasProjectCollection->count()) { ?>
    <ul class="list-group">
        <?php foreach ($hasProjectCollection as $projectEntity) { ?>
            <li class="list-group-item list-group-item-action">
                <div class="btn-group pull-right">
                    <a href="<?= Url::to(['/rest-client/identity/detach', 'projectId' => $projectEntity->getId(), 'userId' => $identityEntity->getId()]) ?>"
                       class="btn btn-xs btn-danger"
                       data-method="post"
                       data-confirm="<?= I18Next::t('restclient', 'access.messages.delete_confirm') ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                <a href="<?= Url::to(['/rest-client/identity/view', 'id' => $projectEntity->getId()]) ?>">
                    <?= $projectEntity->getTitle() ?>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p class="text-muted">Empty list</p>
<?php } ?>