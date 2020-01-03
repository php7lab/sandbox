<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

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
