<?php

namespace PhpLab\Sandbox\Generator\Domain\Services;

use php7extension\core\helpers\ClassHelper;
use php7extension\yii\helpers\Inflector;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Interfaces\DomainServiceInterface;
use PhpLab\Sandbox\Generator\Domain\Scenarios\BaseScenario;

class DomainService implements DomainServiceInterface
{

    public function generate(BuildDto $buildDto)
    {
        foreach ($buildDto->types as $typeName) {
            $type = Inflector::classify($typeName);
            $scenarioInstance = $this->createScenarioByTypeName($type);
            ClassHelper::configure($scenarioInstance, [
                'name' => $buildDto->name,
                'driver' => $buildDto->driver,
                'domainNamespace' => $buildDto->domainNamespace,
            ]);
            $scenarioInstance->run();
        }
    }

    private function createScenarioByTypeName($type): BaseScenario
    {
        $scenarioClass = 'PhpLab\\Sandbox\\Generator\\Domain\Scenarios\\' . $type . 'Scenario';
        /** @var BaseScenario $scenarioInstance */
        $scenarioInstance = new $scenarioClass;
        return $scenarioInstance;
    }

}
