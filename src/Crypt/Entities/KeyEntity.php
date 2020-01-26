<?php

namespace PhpLab\Sandbox\Crypt\Entities;

use php7rails\domain\BaseEntity;
use PhpLab\Sandbox\Crypt\Enums\EncryptAlgorithmEnum;
use PhpLab\Sandbox\Crypt\Enums\EncryptFunctionEnum;
use php7rails\domain\BaseEnum;

/**
 * Class KeyEntity
 * @package PhpLab\Sandbox\Crypt\Entities
 *
 * @property string $type
 * @property string $private
 * @property string $public
 * @property string $secret
 */
class KeyEntity extends BaseEntity {

	protected $type = null;
	protected $private;
    protected $public;
    protected $secret;

    /*public function getType() {
        if(!empty($this->type)) {
            return $this->type;
        }
        if(!empty($this->secret)) {
            return EncryptFunctionEnum::HASH_HMAC;
        }
        if(!empty($this->private) || !empty($this->public)) {
            return EncryptFunctionEnum::OPENSSL;
        }
    }*/
}
