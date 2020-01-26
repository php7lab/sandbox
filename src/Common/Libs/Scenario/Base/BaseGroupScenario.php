<?php

namespace PhpLab\Sandbox\Common\Libs\Scenario\Base;

use PhpLab\Sandbox\Common\Libs\Scenario\Collections\ScenarioCollection;

abstract class BaseGroupScenario extends BaseScenario {

    public $filters = [];

    public function run() {
        if(empty($this->filters)) {
            return;
        }
        $config = $this->getData();

        $filterCollection = new ScenarioCollection($this->filters);
        $config = $filterCollection->runAll($config);

        $this->setData($config);
    }
	
}
