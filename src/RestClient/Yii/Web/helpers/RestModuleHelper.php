<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\helpers;

use yii\helpers\ArrayHelper;
use yii2rails\app\domain\helpers\EnvService;
use yii2rails\extension\web\helpers\Behavior;
use yii2tool\restclient\domain\enums\RestPermissionEnum;
use yii2bundle\rest\domain\helpers\MiscHelper;

class RestModuleHelper {
	
	public static function getConfig() {
		$config = [];
		$apiVersionList = MiscHelper::getAllVersions();
		foreach($apiVersionList as $version) {
			$config[ 'rest-' . $version ] = [
				'class' => 'PhpLab\Sandbox\RestClient\Yii\Web\Module',
				'baseUrl' => EnvService::getUrl('api', $version),
				'as access' => Behavior::access(RestPermissionEnum::CLIENT_ALL),
			];
		}
		return $config;
	}
	
	public static function appendConfig($config) {
		$restClientConfig = RestModuleHelper::getConfig();
		$config = ArrayHelper::merge($config, $restClientConfig);
		return $config;
	}
	
}