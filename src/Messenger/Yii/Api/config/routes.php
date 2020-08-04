<?php

use yii\rest\UrlRule;
$version = API_VERSION_STRING;

return [

    //"POST {$version}/rest-request/<projectId>" => "restclient/request/send",

    ["class" => UrlRule::class, "controller" => ["{$version}/messenger-chat" => "messenger/chat"]],
];
