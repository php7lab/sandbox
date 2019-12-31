<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios;

class EntityScenario extends BaseScenario
{

    public function typeName()
    {
        return 'Entity';
    }

    public function classDir()
    {
        return 'Entities';
    }

    public function interfaceDir()
    {
        return null;
    }
}
