<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\helpers;

use Illuminate\Support\Collection;
use PhpLab\Sandbox\RestClient\Domain\Entities\AuthorizationEntity;
use Yii;
use yii2rails\extension\yii\helpers\ArrayHelper;
use yii2tool\restclient\domain\helpers\AuthorizationHelper;
use yii2bundle\account\domain\v3\entities\LoginEntity;

class Authorization
{

	public static $password = 'Wwwqqq111';

    /**
     * @param Collection | AuthorizationEntity[] $collection
     * @return array
     */
    public static function collectionToOptions(Collection $collection) {
        $loginListForSelect = [];
        if(!empty($collection)) {
            foreach($collection as $authorizationEntity) {
                $loginListForSelect[$authorizationEntity->getUsername()] = $authorizationEntity->getUsername();
            }
        }
        $loginListForSelect = ArrayHelper::merge(['' => 'Guest'], $loginListForSelect);
        return $loginListForSelect;
    }

	public static function loginListForSelect() {
		$loginList = \App::$domain->account->test->all();
	    $loginListForSelect = [];
	    if(!empty($loginList)) {
            foreach($loginList as $login) {
                $loginListForSelect[$login->login] = $login->login . ' - ' . $login->username;
            }
        }
        $loginListForSelect = ArrayHelper::merge(['' => 'Guest'], $loginListForSelect);
        return $loginListForSelect;
    }
	
	public static function getTokenByLogin($login)
    {
	    /** @var LoginEntity $userEntity */
	    $userEntity = $loginList = \App::$domain->account->test->oneByLogin($login);
	    $password = !empty($userEntity->password) ?  $userEntity->password: self::$password;
	    $token = self::getTokenFromRest($userEntity->login, $password);
        return $token;
    }

    private static function getTokenFromRest($login, $password) {
	    $url = self::buildUrl('auth');
	    return AuthorizationHelper::getToken($url, $login, $password);
    }
    
    private static function buildUrl($point = null) {
	    $url = rtrim(Yii::$app->controller->module->baseUrl, SL);
	    if(!empty($point)) {
		    $url .= SL . $point;
	    }
	    return $url;
    }

}