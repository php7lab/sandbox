<?php

namespace PhpLab\Sandbox\Common\Libs\ArrayTools\Filters\Iterator;

use PhpLab\Sandbox\Common\Libs\Scenario\Base\BaseScenario;
use PhpLab\Domain\Data\Query;

class Offset extends BaseScenario {

	public $query;
	
	public function run() {
		$collection = $this->getData();
		$collection = $this->filterWhere($collection, $this->query);
		$this->setData($collection);
	}
	
	protected function filterWhere($collection, Query $query) {
		$offset = $query->getParam('offset', 0);
		$limit = $query->getParam('limit', null);
		if(empty($offset) && empty($limit)) {
			return $collection;
		}
		//prr([$offset, $limit],1,1);
		$collection = array_slice($collection, $offset, $limit);
		return $collection;
	}
}
