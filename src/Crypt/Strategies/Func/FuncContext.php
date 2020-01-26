<?php

namespace PhpLab\Sandbox\Crypt\Strategies\Func;

use php7extension\bundle\account\domain\v3\helpers\LoginTypeHelper;
use PhpLab\Sandbox\Crypt\Dto\TokenDto;
use PhpLab\Sandbox\Crypt\Enums\EncryptFunctionEnum;
use PhpLab\Sandbox\Crypt\Enums\JwtAlgorithmEnum;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\EmailStrategy;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\HmacStrategy;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\LoginStrategy;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\OpenSslStrategy;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\PhoneStrategy;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\TokenStrategy;
use php7rails\domain\BaseEntity;
use php7rails\domain\data\Query;
use php7rails\domain\dto\WithDto;
use php7rails\domain\entities\relation\RelationEntity;
use php7rails\domain\enums\RelationEnum;
use php7extension\core\scenario\base\BaseStrategyContextHandlers;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\One;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\Many;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\ManyToMany;
use PhpLab\Sandbox\Crypt\Strategies\Func\Handlers\HandlerInterface;

/**
 * @property-read HandlerInterface $strategyInstance
 */
class FuncContext extends BaseStrategyContextHandlers {

    public function getStrategyDefinitions() {
        return [
            EncryptFunctionEnum::OPENSSL => OpenSslStrategy::class,
            EncryptFunctionEnum::HASH_HMAC => HmacStrategy::class,
        ];
    }

    public function sign($msg, $algorithm, $key)
    {
        return $this->strategyInstance->sign($msg, $algorithm, $key);
    }

    public function verify($msg, $algorithm, $key, $signature)
    {
        return $this->strategyInstance->verify($msg, $algorithm, $key, $signature);
    }

}