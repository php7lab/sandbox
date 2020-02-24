<?php

/**
 * @var \yii\web\View $this
 * @var \Psr\Http\Message\ResponseInterface $response
 */

use PhpLab\Core\Enums\Http\HttpHeaderEnum;
use PhpLab\Sandbox\RestClient\Yii\Web\HighlightAsset;
use PhpLab\Test\Helpers\RestHelper;

if ($frame) {
    echo '<iframe src="' . $frame . '" width="100%" height="800" align="left"></iframe>';
} else {
    $contentType = RestHelper::extractHeaderValues($response, HttpHeaderEnum::CONTENT_TYPE)[0];
    $formatterConfig = 'PhpLab\Sandbox\RestClient\Yii\Web\formatters\RawFormatter';
    foreach ($this->context->module->formatters as $mimeType => $config) {
        if (strpos($contentType, $mimeType) === 0) {
            $formatterConfig = $config;
            break;
        }
    }
    /** @var \PhpLab\Sandbox\RestClient\Yii\Web\formatters\RawFormatter $formatter */
    $formatter = \Yii::createObject($formatterConfig);
    echo $formatter->format($response->getBody()->getContents());
    HighlightAsset::register($this);
    $this->registerJs('hljs.highlightBlock(document.getElementById("response-content"));');
    $this->registerCss('pre code.hljs {background: transparent}');
}
