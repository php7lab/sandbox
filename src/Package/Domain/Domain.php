<?php

namespace PhpLab\Sandbox\Package\Domain;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'package';
    }

}