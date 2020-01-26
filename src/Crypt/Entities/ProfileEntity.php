<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use PhpLab\Sandbox\Crypt\Enums\EncryptAlgorithmEnum;

/**
 * Class ConfigEntity
 * @package PhpLab\Sandbox\Crypt\Entities
 *
 * @property KeyEntity $key
 * @property string $algorithm
 */
class ProfileEntity
{

    public $key;
    public $algorithm = EncryptAlgorithmEnum::SHA256;


    public function fieldType()
    {
        return [
            'key' => KeyEntity::class,
        ];
    }
}
