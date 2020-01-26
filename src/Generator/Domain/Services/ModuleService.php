<?php

namespace PhpLab\Sandbox\Generator\Domain\Services;

use php7extension\yii\helpers\Inflector;
use PhpLab\Sandbox\Common\Helpers\ClassHelper;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Interfaces\Services\ModuleServiceInterface;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Generate\BaseScenario;

class ModuleService implements ModuleServiceInterface
{

    public function generate(BuildDto $buildDto)
    {
        $type = Inflector::classify($buildDto->typeModule);
        $scenarioInstance = $this->createScenarioByTypeName($type);
        $scenarioParams = [
            'buildDto' => $buildDto,
            'moduleNamespace' => $buildDto->moduleNamespace,
        ];
        ClassHelper::configure($scenarioInstance, $scenarioParams);
        $scenarioInstance->init();
        $scenarioInstance->run();
    }

    private function createScenarioByTypeName($type): BaseScenario
    {
        $scenarioClass = 'PhpLab\\Sandbox\\Generator\\Domain\Scenarios\\Generate\\' . $type . 'Scenario';
        /** @var BaseScenario $scenarioInstance */
        $scenarioInstance = new $scenarioClass;
        return $scenarioInstance;
    }

}
