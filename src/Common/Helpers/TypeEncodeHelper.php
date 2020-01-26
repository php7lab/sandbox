<?php

namespace PhpLab\Sandbox\Common\Helpers;

use php7extension\yii\helpers\ArrayHelper;

class TypeEncodeHelper {
	
	public static function bool($value) {
	    $values = [
	        'true' => true,
	        'false' => false,
	        'on' => true,
	        'off' => false,
	        'yes' => true,
	        'no' => false,
	        '1' => true,
	        '0' => false,
        ];
        $value = ArrayHelper::getValue($values, $value, $value);
        return boolval($value);
    }
	
}
