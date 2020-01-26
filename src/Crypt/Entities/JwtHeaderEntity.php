<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;

/**
 * Class JwtHeaderEntity
 * @package PhpLab\Sandbox\Crypt\Entities
 *
 * @property $typ string
 * @property $alg string
 * @property $kid string
 */
class JwtHeaderEntity
{

    public $typ = 'JWT';
    public $alg = JwtAlgorithmEnum::HS256;
    public $kid;

}
