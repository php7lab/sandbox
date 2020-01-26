<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use php7rails\domain\BaseEntity;
use PhpLab\Sandbox\Crypt\Enums\EncryptAlgorithmEnum;
use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;
use PhpLab\Sandbox\Common\Enums\TimeEnum;

/**
 * Class JwtHeaderEntity
 * @package PhpLab\Sandbox\Crypt\Entities
 *
 * @property $typ string
 * @property $alg string
 * @property $kid string
 */
class JwtHeaderEntity extends BaseEntity {

    protected $typ = 'JWT';
    protected $alg = JwtAlgorithmEnum::HS256;
    protected $kid;

}
