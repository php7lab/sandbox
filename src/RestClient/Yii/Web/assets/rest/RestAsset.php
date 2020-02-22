<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\assets\rest;

use yii\web\AssetBundle;

class RestAsset extends AssetBundle
{
    public $sourcePath = '@yii2tool/restclient/web/assets/rest/dist';
    public $js = [
        'js/domain.js',
        'js/services/http.js',
        'js/services/request.js',
        'js/services/router.js',
    ];
	public $depends = [
		'yii2bundle\applicationTemplate\common\assets\main\MainAsset',
        'PhpLab\Sandbox\RestClient\Yii\Web\assets\account\AccountAsset',
	];
}
