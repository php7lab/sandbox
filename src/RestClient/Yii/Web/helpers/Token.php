<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\helpers;

use yii2rails\extension\store\StoreFile;

class Token
{

    public static $fileAlias = '@runtime/rest-client/data.json';

    static public function load($login) {
        $store = new StoreFile(self::$fileAlias);
        $data = $store->load('token.' . $login);
        return $data;
    }

    static public function save($login, $token) {
        $store = new StoreFile(self::$fileAlias);
        $store->update('token.' . $login, $token);
    }

}