<?php

namespace PhpLab\Sandbox\Common\Exceptions;

use Throwable;
use Exception;

class ClassInstanceException extends Exception {

	public function __construct(string $message = "", int $code = 0, Throwable $previous = null) {
		
		parent::__construct($message, $code, $previous);
	}
}
