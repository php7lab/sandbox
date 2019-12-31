<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios;

class ServiceScenario extends BaseScenario
{

    public function typeName()
    {
        return 'Service';
    }

    public function classDir()
    {
        return 'Services';
    }

    protected function isMakeInterface() : bool {
        return true;
    }
}
