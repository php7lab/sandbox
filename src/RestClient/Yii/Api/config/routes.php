<?php

use yii\rest\UrlRule;
$version = API_VERSION_STRING;

return [
    ["class" => UrlRule::class, "controller" => ["{$version}/rest-project" => "restclient/project"]],

    [
        "class" => UrlRule::class,
        "controller" => [
            "{$version}/rest-favorite" => "restclient/favorite",
            "{$version}/rest-history" => "restclient/history",
        ],
        "except" => [
            'index',
            'updqate',
            'create',
        ],
        "extraPatterns" => [
            "all-by-project/<projectId>" => "all-by-project",
        ],
    ],

    ["class" => UrlRule::class, "controller" => ["{$version}/rest-access" => "restclient/access"]],
    ["class" => UrlRule::class, "controller" => ["{$version}/rest-authorization" => "restclient/authorization"]],
];
