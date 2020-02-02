<?php

namespace PhpLab\Sandbox\Queue\Domain;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'queue';
    }

}