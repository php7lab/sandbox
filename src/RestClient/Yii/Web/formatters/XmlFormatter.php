<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\formatters;

use yii\base\ErrorException;
use yii\helpers\Html;

/**
 * Class XmlFormatter
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class XmlFormatter extends RawFormatter
{
    /**
     * @inheritdoc
     */
    public function format($content)
    {
        $dom = new \DOMDocument();
        $dom->formatOutput = true;
        try {
            $dom->loadXML($content);
        } catch (ErrorException $e) {
            return $this->warn($e) . parent::format($content);
        }
        $xmlContent = $dom->saveXML();

        return Html::tag('pre',
            Html::tag('code',
                Html::encode($xmlContent),
                ['id' => 'response-content', 'class' => 'xml']
            )
        );
    }
}