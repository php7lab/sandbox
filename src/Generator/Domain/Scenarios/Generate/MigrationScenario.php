<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

class MigrationScenario extends BaseScenario
{

    public function typeName()
    {
        return 'Migration';
    }

    public function classDir()
    {
        return 'Migrations';
    }

}
