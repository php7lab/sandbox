<?php

namespace PhpLab\Sandbox\Common\Libs\ArrayTools\Filters\Iterator;

use PhpLab\Sandbox\Common\Libs\Scenario\Base\BaseScenario;
use PhpLab\Domain\Data\Query;
use php7extension\yii\helpers\ArrayHelper;

class Sort extends BaseScenario {

	public $query;
	
	public function run() {
		$collection = $this->getData();
		$collection = $this->filterSort($collection, $this->query);
		$this->setData($collection);
	}
	
	protected function filterSort(Array $collection, Query $query) {
		$orders = $query->getParam('order');
		if (empty($orders)) {
			return $collection;
		}
		ArrayHelper::multisort($collection, array_keys($orders), array_values($orders));
		return $collection;
	}
}
