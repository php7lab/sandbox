<?php

namespace PhpLab\Sandbox\Crypt\Enums;

use php7rails\domain\BaseEnum;

class EncryptFunctionEnum extends BaseEnum {

	const HASH_HMAC = 'hash_hmac';
	const OPENSSL = 'openssl';

}
