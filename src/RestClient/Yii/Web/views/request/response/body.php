<?php

/**
 * @var \yii\web\View $this
 * @var \Psr\Http\Message\ResponseInterface $response
 */

use PhpLab\Core\Enums\Http\HttpHeaderEnum;
use PhpLab\Sandbox\RestClient\Yii\Web\HighlightAsset;
use PhpLab\Test\Helpers\RestHelper;
use yii\helpers\Html;

echo \PhpLab\Sandbox\RestClient\Yii\Web\Widgets\BodyWidget::widget([
    '' => ,
]);

/*if ($frame) {
    echo '<iframe src="' . $frame . '" width="100%" height="800" align="left"></iframe>';
} else {
    $content = $response->getBody()->getContents();
    if($content) {
        try {
            $contentType = RestHelper::extractHeaderValues($response, HttpHeaderEnum::CONTENT_TYPE)[0];
            $formatterConfig = getFormatterConfig($this->context->module->formatters, $contentType);
            $formatter = \Yii::createObject($formatterConfig);
            $contentFormatted = $formatter->format($content);
            echo codeHtml($contentFormatted, $formatter->getFormatName());
            HighlightAsset::register($this);
            $this->registerJs('hljs.highlightBlock(document.getElementById("response-content"));');
            $this->registerCss('pre code.hljs {background: transparent}');
        } catch (Exception $exception) {
            $warningHtml = Html::tag('div', '<strong>Warning!</strong> ' . $exception->getMessage(), [
                'class' => 'alert alert-warning',
            ]);
            echo $warningHtml . codeHtml($content, 'raw');
        }
    } else {
        echo '<div class="alert alert-info">Empty body</div>';
    }
}*/
