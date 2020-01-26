<?php

namespace PhpLab\Sandbox\Common\Enums;

use PhpLab\Domain\Base\BaseEnum;

class StatusEnum extends BaseEnum {

    // откоючен / премодерация
    const DISABLE = 0;

    // включен / одобрен
    const ENABLE = 1;

    // отвергнут
    const REJECTED = 2;

}
