<?php

namespace PhpLab\Sandbox\Crypt\Enums;

use PhpLab\Core\Domain\Base\BaseEnum;

class EncryptFunctionEnum extends BaseEnum
{

    const HASH_HMAC = 'hash_hmac';
    const OPENSSL = 'openssl';

}
