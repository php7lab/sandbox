<?php

namespace PhpLab\Sandbox\Storage\Domain;

use PhpLab\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'storage';
    }


}

