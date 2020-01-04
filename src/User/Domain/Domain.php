<?php

namespace PhpLab\Sandbox\User\Domain;

use PhpLab\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'user';
    }

}