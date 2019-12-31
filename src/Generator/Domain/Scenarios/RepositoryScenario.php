<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios;

class RepositoryScenario extends BaseScenario
{

    public $driver;

    public function typeName()
    {
        return 'Repository';
    }

    public function classDir()
    {
        return 'Repositories\\' . $this->driver;
    }

    protected function isMakeInterface() : bool {
        return true;
    }
}
