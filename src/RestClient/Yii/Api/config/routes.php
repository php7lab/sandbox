<?php

$version = API_VERSION_STRING;

return [
    ["class" => "yii\\rest\UrlRule", "controller" => ["{$version}/rest-project" => "restclient/project"]],
    ["class" => "yii\\rest\UrlRule", "controller" => ["{$version}/rest-access" => "restclient/access"]],
];
