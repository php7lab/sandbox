<?php

namespace PhpLab\Sandbox\Queue\Domain;

use PhpLab\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'queue';
    }

}