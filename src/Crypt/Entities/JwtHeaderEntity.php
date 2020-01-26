<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use PhpLab\Domain\Base\BaseEntity;
use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;

/**
 * Class JwtHeaderEntity
 * @package PhpLab\Sandbox\Crypt\Entities
 *
 * @property $typ string
 * @property $alg string
 * @property $kid string
 */
class JwtHeaderEntity extends BaseEntity
{

    protected $typ = 'JWT';
    protected $alg = JwtAlgorithmEnum::HS256;
    protected $kid;

}
