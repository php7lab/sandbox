<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\assets\account;

use yii\web\AssetBundle;

class AccountAsset extends AssetBundle
{
    public $sourcePath = '@yii2tool/restclient/web/assets/account/dist';
    public $js = [
        'js/domain.js',
        'js/services/auth.js',
        'js/services/token.js',
    ];
	public $depends = [
		//'PhpLab\Sandbox\RestClient\Yii\Web\assets\rest\RestAsset',
        'PhpLab\Sandbox\RestClient\Yii\Web\assets\storage\StorageAsset',
	];
}
