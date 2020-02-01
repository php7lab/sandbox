<?php

namespace PhpLab\Sandbox\Bot\Domain\Helpers;

use PhpLab\Domain\Interfaces\DomainInterface;

class MlHelper
{

    static public function prepareWord($line)
    {
        $line = \PhpLab\Sandbox\Common\Helpers\StringHelper::filterChar($line, '#[^а-яА-ЯёЁa-zA-Z\s]+#u');
        return $line;
    }

}

