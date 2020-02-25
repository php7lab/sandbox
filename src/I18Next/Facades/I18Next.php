<?php

namespace PhpLab\Sandbox\I18Next\Facades;

use PhpLab\Sandbox\I18Next\Services\TranslationService;

class I18Next {

    private static $service;

    public static function t(string $bundleName, string $key, array $variables = []) {
        return self::getService()->t($bundleName, $key, $variables);
    }

    public static function getService(): TranslationService {
        if( ! self::$service) {
            self::$service = new TranslationService;
        }
        return self::$service;
    }

}
