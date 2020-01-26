<?php

namespace PhpLab\Sandbox\Common\Helpers\Types;

use php7extension\yii\base\InvalidArgumentException;
use PhpLab\Sandbox\Common\Helpers\ClassHelper;

abstract class BaseType {
	
	abstract protected function _isValid($value, $params = null);
	abstract public function normalizeValue($value, $params = null);
	
	public function validate($value, $params = null) {
		if(!$this->isValid($value, $params)) {
			$class = ClassHelper::getClassOfClassName(static::class);
			throw new InvalidArgumentException('Value "' . $value . '" not valid of "' . $class . '"!');
		}
	}
	
	public function isValid($value, $params = null) {
		if($value === null) {
			return true;
		}
		return $this->_isValid($value, $params);
	}
}