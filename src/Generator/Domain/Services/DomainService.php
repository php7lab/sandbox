<?php

namespace PhpLab\Sandbox\Generator\Domain\Services;

use php7extension\yii\helpers\Inflector;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Interfaces\DomainServiceInterface;
use PhpLab\Sandbox\Generator\Domain\Scenarios\BaseScenario;

class DomainService implements DomainServiceInterface
{

    public function generate(BuildDto $buildDto)
    {
        foreach ($buildDto->types as $typeIndex) {
            $type = $buildDto->typeArray[$typeIndex];
            $type = Inflector::classify($type);
            $scenarioClass = 'PhpLab\\Sandbox\\Generator\\Domain\Scenarios\\' . $type . 'Scenario';
            /** @var BaseScenario $scenarioInstance */
            $scenarioInstance = new $scenarioClass;
            \php7extension\core\helpers\ClassHelper::configure($scenarioInstance, [
                'name' => $buildDto->name,
                'driver' => $buildDto->driver,
            ]);
            //$scenarioInstance->name = $name;
            $scenarioInstance->domainNamespace = $buildDto->domainNamespace;
            $scenarioInstance->run();
            //dd($scenarioInstance);
        }
    }

}
