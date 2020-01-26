<?php

namespace PhpLab\Sandbox\Crypt\Helpers;

use php7extension\yii\helpers\ArrayHelper;
use php7rails\app\domain\helpers\EnvService;
use PhpLab\Sandbox\Crypt\Entities\KeyEntity;
use PhpLab\Sandbox\Crypt\Enums\EncryptAlgorithmEnum;
use PhpLab\Sandbox\Crypt\Enums\RsaBitsEnum;
use php7rails\domain\BaseEnum;

class RsaHelper {

    public static function generate(string $password = null, int $keyBits = RsaBitsEnum::BIT_2048, int $keyType = OPENSSL_KEYTYPE_RSA, $algorithm = EncryptAlgorithmEnum::SHA256) : KeyEntity
    {
        $config = [
            "digest_alg" => $algorithm,
            "private_key_bits" => $keyBits,
            "private_key_type" => $keyType,
        ];
        $resource = openssl_pkey_new ( $config );
        $keyEntity = new KeyEntity;
        $keyEntity->private = self::extractPrivateKey($resource, $password);
        $keyEntity->public = self::extractPublicKey($resource);
        return $keyEntity;
    }

    public static function extractPrivateKey($resource, string $password = null) : string {
        openssl_pkey_export ( $resource, $privateKey, $password);
        return $privateKey;
    }

    public static function extractPublicKey($resource) : string {
        $publicKey = openssl_pkey_get_details ( $resource );
        $publicKey = $publicKey["key"];
        return $publicKey;
    }

}
