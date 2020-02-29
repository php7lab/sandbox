<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\formatters;

use yii\base\BaseObject;

/**
 * Class RawFormatter
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 */
class RawFormatter
{

    public function getFormatName(): string
    {
        return 'raw';
    }

    public function format(string $content): string
    {
        return $content;
    }

}