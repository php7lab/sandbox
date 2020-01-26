<?php

namespace PhpLab\Sandbox\Crypt\Helpers;

use PhpLab\Sandbox\Crypt\Entities\KeyEntity;
use PhpLab\Sandbox\Crypt\Enums\EncryptAlgorithmEnum;
use PhpLab\Sandbox\Crypt\Enums\EncryptFunctionEnum;
use php7rails\domain\BaseEnum;

class EncryptHelper {

    public static function sign($msg, string $profileName)
    {
        $profile = ConfigProfileHelper::load($profileName);
        $key = $profile->key->type === OPENSSL_KEYTYPE_RSA ? $profile->key->private : $profile->key->private;
        $function = self::getFunction($profile->key);
        return SignatureHelper::sign($msg, $key, $function, $profile->algorithm);
    }

    public static function verify($msg, string $profileName, $signature)
    {
        $profile = ConfigProfileHelper::load($profileName);
        $key = $profile->key->type === OPENSSL_KEYTYPE_RSA ? $profile->key->public : $profile->key->private;
        $function = self::getFunction($profile->key);
        return SignatureHelper::verify($msg, $key, $signature, $function, $profile->algorithm);
    }

    private static function getFunction(KeyEntity $keyEntity) {
        return $keyEntity->type === OPENSSL_KEYTYPE_RSA ? EncryptFunctionEnum::OPENSSL : EncryptFunctionEnum::HASH_HMAC;;
    }

    public static function safeStrlen($str)
    {
        return mb_strlen($str, '8bit');
    }

}
