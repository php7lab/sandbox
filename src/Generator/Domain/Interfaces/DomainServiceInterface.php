<?php

namespace PhpLab\Sandbox\Generator\Domain\Interfaces;

use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;

interface DomainServiceInterface
{

    public function generate(BuildDto $buildDto);

}