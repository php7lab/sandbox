<?php

namespace PhpLab\Sandbox\Crypt\Helpers;

use DomainException;
use InvalidArgumentException;
use php7extension\yii\helpers\ArrayHelper;
use php7rails\extension\jwt\entities\ProfileEntity;
use php7rails\extension\jwt\entities\TokenEntity;
use PhpLab\Sandbox\Crypt\Dto\TokenDto;
use PhpLab\Sandbox\Crypt\Entities\JwtHeaderEntity;
use PhpLab\Sandbox\Crypt\Entities\JwtProfileEntity;
use PhpLab\Sandbox\Crypt\Entities\KeyEntity;
use PhpLab\Sandbox\Crypt\Enums\EncryptFunctionEnum;
use PhpLab\Sandbox\Crypt\Enums\EncryptKeyTypeEnum;
use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;
use PhpLab\Sandbox\Crypt\Exceptions\SignatureInvalidException;
use PhpLab\Sandbox\Crypt\Strategies\Func\FuncContext;

class JwtEncodeHelper
{

    public static function decode(string $jwt): TokenDto
    {
        $tokenDto = JwtModelHelper::parseToken($jwt);
        return $tokenDto;
    }

    public static function verifyTokenDto(TokenDto $tokenDto, JwtProfileEntity $profileEntity)
    {
        JwtModelHelper::validateToken($tokenDto, $profileEntity->allowed_algs);
        JwtModelHelper::verifyTime($tokenDto);
        self::verifySignature($tokenDto, $profileEntity->key);
    }


    public static function encode(array $payload, KeyEntity $keyEntity, JwtHeaderEntity $jwtHeaderEntity = null): string
    {
        $tokenDto = new TokenDto;
        $tokenDto->header_encoded = JwtSegmentHelper::encodeSegment(ArrayHelper::toArray($jwtHeaderEntity));
        $tokenDto->payload_encoded = JwtSegmentHelper::encodeSegment($payload);
        $signature = static::sign($tokenDto, $keyEntity, $jwtHeaderEntity->alg);
        $tokenDto->signature_encoded = SafeBase64Helper::encode($signature);
        return self::buildTokenFromDto($tokenDto);
    }

    private static function buildTokenFromDto(TokenDto $tokenDto, $full = true): string
    {
        $token = $tokenDto->header_encoded . '.' . $tokenDto->payload_encoded;
        if ($full && $tokenDto->signature_encoded) {
            $token .= '.' . $tokenDto->signature_encoded;
        }
        return $token;
    }

    private static function extractKey(KeyEntity $keyEntity, $type = EncryptKeyTypeEnum::PRIVATE)
    {

        $isRsa = $keyEntity->type === OPENSSL_KEYTYPE_RSA;
        if ($isRsa) {
            $key = ArrayHelper::getValue($keyEntity, $type);
        } else {
            $key = ArrayHelper::getValue($keyEntity, EncryptKeyTypeEnum::PRIVATE);
        }

        /*if($keyEntity->type === OPENSSL_KEYTYPE_RSA && ) {
            $key = $keyEntity->public;
        } else {
            $key = $keyEntity->private;
        }*/
        if (empty($key)) {
            throw new InvalidArgumentException('Key may not be empty');
        }
        return $key;
    }

    private static function verifySignature(TokenDto $tokenDto, KeyEntity $keyEntity)
    {
        $isVerified = static::verify($tokenDto, $keyEntity);
        if ( ! $isVerified) {
            throw new SignatureInvalidException('Signature verification failed');
        }
    }

    private static function sign(TokenDto $tokenDto, KeyEntity $keyEntity, $alg = JwtAlgorithmEnum::HS256)
    {
        $key = self::extractKey($keyEntity, EncryptKeyTypeEnum::PRIVATE);
        $msg = self::buildTokenFromDto($tokenDto, false);
        if ( ! JwtAlgorithmEnum::isSupported($alg)) {
            throw new DomainException('Algorithm not supported');
        }
        $algorithm = JwtAlgorithmEnum::getHashAlgorithm($alg);
        $function = self::getFunction($keyEntity->type);
        $loginContext = new FuncContext;
        $loginContext->setStrategyName($function);
        return $loginContext->sign($msg, $algorithm, $key);
    }

    private static function verify(TokenDto $tokenDto, KeyEntity $keyEntity)
    {
        $key = self::extractKey($keyEntity, EncryptKeyTypeEnum::PUBLIC);
        JwtModelHelper::validateKey($tokenDto, $key);
        $msg = self::buildTokenFromDto($tokenDto, false);
        $signature = $tokenDto->signature;
        $alg = $tokenDto->header->alg;
        $algorithm = JwtAlgorithmEnum::getHashAlgorithm($alg);
        $function = self::getFunction($keyEntity->type);
        $loginContext = new FuncContext;
        $loginContext->setStrategyName($function);
        return $loginContext->verify($msg, $algorithm, $key, $signature);
    }

    private static function getFunction($type)
    {
        $isRsa = $type === OPENSSL_KEYTYPE_RSA;
        $function = $isRsa ? EncryptFunctionEnum::OPENSSL : EncryptFunctionEnum::HASH_HMAC;
        return $function;
    }

}
