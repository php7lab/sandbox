<?php

namespace PhpLab\Sandbox\Messenger\Domain;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'messenger';
    }

}