<?php

use yii\helpers\Html;
use yii\web\Response;

/**
 * @var \yii\web\View $this
 * @var \Psr\Http\Message\ResponseInterface $response
 */
?>
<div id="response" class="rest-request-response">
    <?php if ($response->getStatusCode()): ?>

        <ul class="nav nav-tabs">
            <li>
                <a href="#response-body" data-toggle="tab">
                    Response Body
                </a>
            </li>
            <li>
                <a href="#response-headers" data-toggle="tab">
                    Response Headers
                    <?= Html::tag('span', count($response->getHeaders()), [
                        'class' => 'counter' . (!count($response->getHeaders()) ? ' hidden' : '')
                    ]) ?>
                </a>
            </li>
            <li class="pull-right">
                <div class="info">
                    Duration:
                    <span class="label label-default">
                        <?= round($duration * 1000) ?> ms
                    </span>
                </div>
            </li>
            <li class="pull-right">
                <div class="info">
                    Status:
                    <?php
                    $class = 'label';
                    if ($response->getStatusCode() < 300) {
                        $class .= ' label-success';
                    } elseif ($response->getStatusCode() < 400) {
                        $class .= ' label-info';
                    } elseif ($response->getStatusCode() < 500) {
                        $class .= ' label-warning';
                    } else {
                        $class .= ' label-danger';
                    }
                    ?>
                    <span class="<?= $class ?>">
                        <?= Html::encode($response->getStatusCode()) ?>
                        <?= isset(Response::$httpStatuses[$response->getStatusCode()]) ? Response::$httpStatuses[$response->getStatusCode()] : '' ?>
                    </span>
                </div>
            </li>
        </ul>


        <div class="tab-content">

            <div id="response-body" class="tab-pane">
                <?php
                if($frame) {
	                echo '<iframe src="'.$frame.'" width="468" height="60" align="left"></iframe>';
	               
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
	                $this->registerJs('hljs.highlightBlock(document.getElementById("response-content"));');
	                $this->registerCss('pre code.hljs {background: transparent}');
                }
               
                ?>
            </div><!-- #response-body -->

            <div id="response-headers" class="tab-pane">
                <table class="table table-striped table-bordered">
                    <!--<thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                        </tr>
                    </thead>-->
                    <tbody>
                        <?php foreach ($response->getHeaders() as $name => $values): ?>
                            <?php foreach ($values as $value): ?>
                                <tr>
                                    <th><?= Html::encode($name) ?></th>
                                    <td><samp><?= Html::encode($value) ?></samp></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php  ?>
            </div><!-- #response-headers -->

        </div>
    <?php endif; ?>
</div>
<?php
$this->registerJs(<<<JS

if (window.localStorage) {
    var responseTab = localStorage['responseTab'] || 'response-body';
    $('a[href="#' + responseTab + '"]').tab('show');
    $('a[href="#response-body"]').on('shown.bs.tab', function() {
        localStorage['responseTab'] = 'response-body';
    });
    $('a[href="#response-headers"]').on('shown.bs.tab', function() {
        localStorage['responseTab'] = 'response-headers';
    });
}

JS
);
$this->registerCss(<<<'CSS'

.nav-tabs > li > .info {
    position: relative;
    display: block;
    padding: 10px 0 10px 15px;
    font-weight: bold;
}
.nav-tabs > li > .info .label {
    white-space: normal;
    font-size: 85%;
}
#response-headers tbody td {
    word-break: break-all;
}
#response-headers tbody th {
    width: 30%;
}
CSS
);