<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\formatters;

use yii\base\BaseObject;
use yii\helpers\Html;

/**
 * Class RawFormatter
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class RawFormatter extends BaseObject
{
    /**
     * @param string $record
     * @return string
     */
    public function format($content)
    {
        return Html::tag('pre',
            Html::tag('code',
                Html::encode($content),
                ['id' => 'response-content']
            )
        );
    }

    /**
     * @param \Exception $exception
     * @return string
     */
    protected function warn($exception)
    {
        return Html::tag('div', '<strong>Warning!</strong> ' . $exception->getMessage(), [
            'class' => 'alert alert-warning',
        ]);
    }
}