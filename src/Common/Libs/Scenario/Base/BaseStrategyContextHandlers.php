<?php

namespace PhpLab\Sandbox\Common\Libs\Scenario\Base;

use php7extension\yii\helpers\ArrayHelper;
use PhpLab\Sandbox\Common\Exceptions\InvalidArgumentException;

/**
 * Class BaseStrategyContext
 *
 * @package PhpLab\Sandbox\Common\Libs\Scenario\Base
 *
 * @property-read Object $strategyInstance
 * @property-read array $strategyDefinitions
 * @property-write string $strategyName
 */
abstract class BaseStrategyContextHandlers extends BaseStrategyContext
{

    private $strategyDefinitions = [];

    public function getStrategyDefinitions()
    {
        return $this->strategyDefinitions;
    }

    public function setStrategyDefinitions(array $handlers)
    {
        $this->strategyDefinitions = $handlers;
    }

    public function forgeStrategyInstanceByName(string $strategyName)
    {
        $this->validate($strategyName);
        $strategyDefinition = ArrayHelper::getValue($this->getStrategyDefinitions(), $strategyName);
        return $this->forgeStrategyInstance($strategyDefinition);
    }

    public function setStrategyName(string $strategyName)
    {
        $this->validate($strategyName);
        $strategyDefinition = ArrayHelper::getValue($this->getStrategyDefinitions(), $strategyName);
        $this->setStrategyDefinition($strategyDefinition);
    }

    protected function validate($name)
    {
        $strategyHandlers = $this->getStrategyDefinitions();
        if (empty($strategyHandlers)) {
            throw new InvalidArgumentException('Strategy handlers not defined!');
        }
        if ( ! isset($strategyHandlers[$name])) {
            throw new InvalidArgumentException('Handler "' . $name . '" not found!');
        }
    }

}
