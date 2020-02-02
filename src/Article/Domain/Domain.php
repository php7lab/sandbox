<?php

namespace PhpLab\Sandbox\Article\Domain;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'article';
    }

}