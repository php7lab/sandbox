<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios;

abstract class BaseScenario
{

    public $domainNamespace;
    public $name;
    
    abstract public function run();

}
