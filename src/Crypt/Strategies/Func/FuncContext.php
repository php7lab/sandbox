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
use PhpLab\Domain\Base\BaseEntity;
use PhpLab\Domain\Data\Query;
use PhpLab\Domain\Dto\WithDto;
use PhpLab\Domain\Entities\relation\RelationEntity;
use PhpLab\Domain\Enums\RelationEnum;
use PhpLab\Sandbox\Common\Libs\Scenario\Base\BaseStrategyContextHandlers;
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
        return $this->getStrategyInstance()->sign($msg, $algorithm, $key);
    }

    public function verify($msg, $algorithm, $key, $signature)
    {
        return $this->getStrategyInstance()->verify($msg, $algorithm, $key, $signature);
    }

}