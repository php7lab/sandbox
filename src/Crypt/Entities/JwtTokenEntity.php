<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use php7rails\domain\BaseEntity;
use PhpLab\Sandbox\Crypt\Entities\JwtHeaderEntity;

/**
 * Class JwtTokenEntity
 * 
 * @package php7rails\extension\jwt\entities
 *
 * @property $header array
 * @property $payload array
 * @property $sig string
 */
class JwtTokenEntity extends BaseEntity {

    protected $header;
    protected $payload;
    protected $sig;

    public function fieldType()
    {
        return [
            'header' => JwtHeaderEntity::class,
        ];
    }
}
