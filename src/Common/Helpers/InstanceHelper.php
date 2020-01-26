<?php

namespace PhpLab\Sandbox\Common\Helpers;

use InvalidArgumentException;
use PhpLab\Sandbox\Common\Exceptions\InvalidConfigException;
use php7extension\yii\web\ServerErrorHttpException;
use PhpLab\Sandbox\Common\Exceptions\ClassInstanceException;

class InstanceHelper {

	public static function create($definition, $data, $interfaceClass = null) {
		$definition = ClassHelper::normalizeComponentConfig($definition);
		$handlerInstance = ClassHelper::createObject($definition);
		if($interfaceClass) {
			ClassHelper::isInstanceOf($handlerInstance, $interfaceClass);
		}
		ClassHelper::configure($handlerInstance, $data);
		return $handlerInstance;
	}

	public static function ensure($definition, $data = [], $interfaceClass = null) {
		if(is_object($definition)) {
			if($interfaceClass) {
				ClassHelper::isInstanceOf($definition, $interfaceClass);
			}
			return $definition;
		}
		return self::create($definition, $data, $interfaceClass);
	}

}