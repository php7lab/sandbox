<?php

namespace PhpLab\Sandbox\Common\Helpers;

use Yii;
use php7extension\yii\base\Behavior;
use php7extension\yii\base\Component;
use php7extension\yii\base\InvalidArgumentException;
use php7extension\yii\base\InvalidConfigException;
use php7extension\yii\web\ServerErrorHttpException;
use PhpLab\Sandbox\Common\Exceptions\ClassInstanceException;

class ComponentHelper {


	/**
	 * Detaches a behavior from the component.
	 * The behavior's [[Behavior::detach()]] method will be invoked.
	 * @param Component $instance
	 * @param string $behaviorClass the behavior's class.
	 * @return null|Behavior the detached behavior. Null if the behavior does not exist.
	 */
	public static function detachBehaviorByClass(Component $instance, $behaviorClass)
	{
		foreach ($instance->getBehaviors() as $key => $value) {
			if ($value instanceof $behaviorClass) {
				return $instance->detachBehavior($key);
			};
		}
		return null;
	}



}