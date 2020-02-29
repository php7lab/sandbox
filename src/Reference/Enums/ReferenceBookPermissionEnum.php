<?php

namespace PhpLab\Sandbox\Reference\Enums;

use PhpLab\Core\Domain\Base\BaseEnum;

class ReferenceBookPermissionEnum extends BaseEnum
{

    const WRITE = 'oReferenceBookWrite';
    const READ = 'oReferenceBookRead';

    public static function getLabels() {
        return [
            self::WRITE => 'Справочник. Модификация',
            self::READ => 'Справочник. Чтение',
        ];
    }

}
