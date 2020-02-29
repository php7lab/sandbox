<?php

namespace PhpLab\Sandbox\Reference;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'reference';
    }


}

