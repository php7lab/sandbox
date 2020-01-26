<?php

namespace PhpLab\Sandbox\Common\Libs\Scenario\Base;

use PhpLab\Sandbox\Common\Helpers\InstanceHelper;
use PhpLab\Sandbox\Common\Helpers\ClassHelper;

/**
 * Class BaseStrategyContext
 *
 * @package PhpLab\Sandbox\Common\Libs\Scenario\Base
 *
 * @property-read Object $strategyInstance
 */
abstract class BaseStrategyContext {
	
	private $strategyInstance;
	
	public function getStrategyInstance() {
		return $this->strategyInstance;
	}
	
	public function setStrategyInstance($strategyInstance) {
		$this->strategyInstance = $strategyInstance;
	}
	
	public function setStrategyDefinition($strategyDefinition) {
		$strategyInstance = $this->forgeStrategyInstance($strategyDefinition);
		$this->setStrategyInstance($strategyInstance);
	}
	
	public function forgeStrategyInstance($strategyDefinition) {
		$strategyInstance = InstanceHelper::create($strategyDefinition, []);
		return $strategyInstance;
	}
	
}
