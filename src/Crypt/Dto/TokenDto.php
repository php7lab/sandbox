<?php

namespace PhpLab\Sandbox\Crypt\Dto;

use PhpLab\Domain\Base\BaseEntity;

/**
 * Class TokenDto
 * @package PhpLab\Sandbox\Crypt\Dto
 *
 * @property $header_encoded
 * @property $payload_encoded
 * @property $signature_encoded
 * @property $header
 * @property $payload
 * @property $signature
 */
class TokenDto extends BaseEntity {

    protected $header_encoded = null;
    protected $payload_encoded = null;
    protected $signature_encoded = null;

    protected $header = null;
    protected $payload = null;
    protected $signature = null;

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['header_encoded']);
        unset($fields['payload_encoded']);
        unset($fields['signature_encoded']);
        return $fields;
    }

}
