<?php

namespace PhpLab\Sandbox\Common\Libs\Store\Drivers;

use php7extension\yii\helpers\ArrayHelper;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml implements DriverInterface
{

    public function decode($content) {

        $data = SymfonyYaml::parse($content);
        //$data = ArrayHelper::toArray($data);
        return $data;
    }

    public function encode($data) {
        $content = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	    $content = str_replace('    ', "\t", $content);
        return $content;
    }

}