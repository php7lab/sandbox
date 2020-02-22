<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\formatters;

use yii\base\InvalidArgumentException;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class JsonFormatter
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class JsonFormatter extends RawFormatter
{
    /**
     * @inheritdoc
     */
    public function format($content)
    {
        try {
            $data = Json::decode($content);
        } catch (InvalidArgumentException $e) {
            return $this->warn($e) . parent::format($content);
        }
        $jsonContent = Json::encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return Html::tag('pre',
            Html::tag('code',
                Html::encode($jsonContent),
                ['id' => 'response-content', 'class' => 'json']
            )
        );
    }
}