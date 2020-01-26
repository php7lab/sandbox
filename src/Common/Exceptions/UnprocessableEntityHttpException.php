<?php

namespace PhpLab\Sandbox\Common\Exceptions;

use InvalidArgumentException;
use PhpLab\Domain\Helpers\ErrorCollection;
use Exception;
use php7extension\yii\helpers\ArrayHelper;
use php7extension\bundle\error\domain\helpers\UnProcessibleHelper;

class UnprocessableEntityHttpException extends Exception {
	
	private $errors = [];
	
	public function __construct($errors, $code = 0, Exception $previous = null) {
		$message = '';
		if (!empty($errors)) {
			$errors = UnProcessibleHelper::assoc2indexed($errors);
			$message = json_encode(ArrayHelper::toArray($errors));
		}
		parent::__construct(422, $message, $code, $previous);
		$this->setErrors($errors);
	}
	
	public function getErrors() {
		return $this->errors;
	}
	
	public function getErrorsForModel() {
		return UnProcessibleHelper::indexed2assoc($this->errors);
	}
	
	private function setErrors($errors) {
		if ($errors instanceof ErrorCollection) {
			$errors = $errors->all();
		}
		if(empty($errors)){
			throw new InvalidArgumentException("error collection is empty");
		}
		$this->errors = $errors;
	}
}
