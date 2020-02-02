<?php

namespace PhpLab\Sandbox\Dev\Domain;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'dev';
    }

}