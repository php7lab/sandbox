<?php

namespace PhpLab\Sandbox\Bot\Domain;

use PhpLab\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'bot';
    }


}

