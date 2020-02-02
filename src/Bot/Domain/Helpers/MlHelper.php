<?php

namespace PhpLab\Sandbox\Bot\Domain\Helpers;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class MlHelper
{

    static public function prepareWord($line)
    {
        $line = \PhpLab\Core\Common\Helpers\StringHelper::filterChar($line, '#[^а-яА-ЯёЁa-zA-Z\s]+#u');
        return $line;
    }

}

