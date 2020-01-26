<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use PhpLab\Sandbox\Common\Enums\TimeEnum;
use PhpLab\Sandbox\Crypt\Enums\EncryptAlgorithmEnum;
use PhpLab\Sandbox\Crypt\Enums\EncryptFunctionEnum;
use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;

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
class JwtProfileEntity extends ProfileEntity
{

    public $name;
    public $life_time = TimeEnum::SECOND_PER_MINUTE * 20;
    // protected $allowed_algs = ['HS256', 'SHA512', 'HS384', 'RS256'];
    public $allowed_algs = [
        JwtAlgorithmEnum::HS256,
        JwtAlgorithmEnum::HS512,
        JwtAlgorithmEnum::HS384,
        JwtAlgorithmEnum::RS256,
    ];
    public $default_alg = JwtAlgorithmEnum::HS256;
    public $hash_alg = EncryptAlgorithmEnum::SHA256;
    public $func = EncryptFunctionEnum::HASH_HMAC;
    public $audience = [];
    public $issuer_url;

}
