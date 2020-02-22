<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\assets\storage;

use yii\web\AssetBundle;

class StorageAsset extends AssetBundle
{
    public $sourcePath = '@yii2tool/restclient/web/assets/storage/dist';
    public $js = [
        'js/domain.js',
        'js/services/local.js',
    ];
}
