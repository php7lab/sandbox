<?php

namespace PhpLab\Sandbox\Common\Helpers\Types;

class BooleanType extends BaseType {
	
	protected function _isValid($value, $params = null) {
        //$value = $this->prepare($value);
		return is_numeric($value) || is_bool($value);
	}
	
	public function normalizeValue($value, $params = null) {
	    //$value = $this->prepare($value);
		$value = boolval($value);
		return $value;
	}

	private function prepare($value) {
        if($value == 'true') {
            $value = true;
        }
        if($value == 'false') {
            $value = false;
        }
        return $value;
    }
}