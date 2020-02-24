<?php

namespace PhpLab\Sandbox\RestClient\Domain\Enums;

use PhpLab\Core\Domain\Base\BaseEnum;

class RestClientPermissionEnum extends BaseEnum
{

    const PROJECT_WRITE = 'oRestClientProjectWrite';
    const PROJECT_READ = 'oRestClientProjectRead';

    /** @deprecated */
    const CLIENT_ALL = 'oRestClientAll';

    public static function getLabels() {
        return [
            self::PROJECT_WRITE => 'REST-клиент. Модификация проекта',
            self::PROJECT_READ => 'REST-клиент. . Чтение проекта',
            self::CLIENT_ALL => 'Доступ к REST-клиенту',
        ];
    }

}
