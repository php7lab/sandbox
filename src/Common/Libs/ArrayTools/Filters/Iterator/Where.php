<?php

namespace PhpLab\Sandbox\Common\Libs\ArrayTools\Filters\Iterator;

use php7extension\yii\helpers\ArrayHelper;
use PhpLab\Domain\Data\Query;
use PhpLab\Sandbox\Common\Libs\Scenario\Base\BaseScenario;

class Where extends BaseScenario
{

    public $query;

    public function run()
    {
        $collection = $this->getData();
        $collection = $this->filterWhere($collection, $this->query);
        $this->setData($collection);
    }

    protected function filterWhere(Array $collection, Query $query)
    {
        $condition = [];
        $where = $query->getParam('where');
        if (empty($where)) {
            return $collection;
        }
        foreach ($where as $name => $value) {
            $key = 'where.' . $name;
            if ($query->hasParam($key)) {
                $condition[$name] = $query->getParam($key);
            }
        }
        $collection = ArrayHelper::findAll($collection, $condition);
        return $collection;
    }
}
