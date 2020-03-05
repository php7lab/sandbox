<?php

use PhpLab\Core\Libs\I18Next\Facades\I18Next;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \Packages\User\Domain\Entities\IdentityEntity[] | \Illuminate\Support\Collection $identityCollection
 */

$this->title = I18Next::t('restclient', 'identity.list_title');

?>

<h2>
    <?= $this->title ?>
</h2>

<?php if($identityCollection->count()) { ?>
    <ul class="list-group">
        <?php foreach ($identityCollection as $projectEntity) { ?>
            <li class="list-group-item list-group-item-action">
                <div class="btn-group pull-right">
                    <a href="<?= Url::to(['/rest-client/identity/update', 'id' => $projectEntity->getId()]) ?>"
                            class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="<?= Url::to(['/rest-client/identity/delete', 'id' => $projectEntity->getId()]) ?>"
                            class="btn btn-xs btn-danger"
                            data-method="post"
                            data-confirm="<?= I18Next::t('restclient', 'identity.messages.delete_confirm') ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                <a href="<?= Url::to(['/rest-client/identity/view', 'id' => $projectEntity->getId()]) ?>">
                    <?= $projectEntity->getLogin() ?>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p class="text-muted">Empty list</p>
<?php } ?>

<a href="<?= Url::to(['/rest-client/identity/create']) ?>" class="btn btn-success"><?= I18Next::t('core', 'action.create') ?></a>
