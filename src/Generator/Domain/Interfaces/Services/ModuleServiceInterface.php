<?php

namespace PhpLab\Sandbox\Generator\Domain\Interfaces\Services;

use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;

interface ModuleServiceInterface {

    public function generate(BuildDto $buildDto);

}