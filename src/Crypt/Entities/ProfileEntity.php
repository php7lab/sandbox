<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use php7rails\domain\BaseEntity;
use PhpLab\Sandbox\Crypt\Enums\EncryptAlgorithmEnum;

/**
 * Class ConfigEntity
 * @package PhpLab\Sandbox\Crypt\Entities
 *
 * @property KeyEntity $key
 * @property string $algorithm
 */
class ProfileEntity extends BaseEntity {

	protected $key;
	protected $algorithm = EncryptAlgorithmEnum::SHA256;


	public function fieldType()
    {
        return [
            'key' => KeyEntity::class,
        ];
    }
}
