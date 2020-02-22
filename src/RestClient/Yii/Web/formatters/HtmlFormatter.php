<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\formatters;

use yii\helpers\Html;

/**
 * Class HtmlFormatter
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class HtmlFormatter extends RawFormatter
{
    /**
     * @inheritdoc
     */
    public function format($content)
    {
        return Html::tag('pre',
            Html::tag('code',
                Html::encode($content),
                ['id' => 'response-content', 'class' => 'html']
            )
        );
    }
}