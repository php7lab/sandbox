<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use PhpLab\Domain\Base\BaseEntity;
use PhpLab\Sandbox\Crypt\Enums\EncryptAlgorithmEnum;
use PhpLab\Sandbox\Crypt\Enums\EncryptFunctionEnum;
use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;
use PhpLab\Sandbox\Common\Enums\TimeEnum;

/**
 * Class JwtProfileEntity
 * @package PhpLab\Sandbox\Crypt\Entities
 *
 * @property $name string
 * @property $life_time integer
 * @property $allowed_algs string[]
 * @property $default_alg string
 * @property $hash_alg string
 * @property $func string
 * @property $audience string[]
 * @property $issuer_url string
 */
class JwtProfileEntity extends ProfileEntity {

    protected $name;
    protected $life_time = TimeEnum::SECOND_PER_MINUTE * 20;
    // protected $allowed_algs = ['HS256', 'SHA512', 'HS384', 'RS256'];
    protected $allowed_algs = [
        JwtAlgorithmEnum::HS256,
        JwtAlgorithmEnum::HS512,
        JwtAlgorithmEnum::HS384,
        JwtAlgorithmEnum::RS256,
    ];
    protected $default_alg = JwtAlgorithmEnum::HS256;
    protected $hash_alg = EncryptAlgorithmEnum::SHA256;
    protected $func = EncryptFunctionEnum::HASH_HMAC;
    protected $audience = [];
    protected $issuer_url;

}
