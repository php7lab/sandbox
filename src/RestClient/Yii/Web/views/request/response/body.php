<?php

/**
 * @var \yii\web\View $this
 * @var \Psr\Http\Message\ResponseInterface $response
 */

use yii\helpers\Html;

if ($frame) {
    echo '<iframe src="' . $frame . '" width="100%" height="800" align="left"></iframe>';
} else {
    $contentType = $response->getHeader('Content-Type')[0];
    $contentType = explode(';', $contentType)[0];
    $contentType = trim($contentType);
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
    \PhpLab\Sandbox\RestClient\Yii\Web\HighlightAsset::register($this);
}
