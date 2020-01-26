<?php

namespace PhpLab\Sandbox\Common\Libs\ArrayTools\Filters\Iterator;

use php7extension\yii\helpers\ArrayHelper;
use PhpLab\Domain\Data\Query;
use PhpLab\Sandbox\Common\Libs\Scenario\Base\BaseScenario;

class Sort extends BaseScenario
{

    public $query;

    public function run()
    {
        $collection = $this->getData();
        $collection = $this->filterSort($collection, $this->query);
        $this->setData($collection);
    }

    protected function filterSort(Array $collection, Query $query)
    {
        $orders = $query->getParam('order');
        if (empty($orders)) {
            return $collection;
        }
        ArrayHelper::multisort($collection, array_keys($orders), array_values($orders));
        return $collection;
    }
}
