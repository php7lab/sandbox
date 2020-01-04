<?php

namespace PhpLab\Sandbox\Messenger\Domain;

use PhpLab\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'messenger';
    }

}