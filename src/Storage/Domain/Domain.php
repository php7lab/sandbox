<?php

namespace PhpLab\Sandbox\Storage\Domain;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'storage';
    }


}

