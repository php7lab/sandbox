<?php

namespace PhpLab\Sandbox\Notify\Domain;

use PhpLab\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'notify';
    }

}