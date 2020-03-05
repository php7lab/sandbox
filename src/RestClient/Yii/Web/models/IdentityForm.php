<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\models;

use PhpLab\Core\Libs\I18Next\Facades\I18Next;
use yii\base\Model;

class IdentityForm extends Model
{

    public $login;

    public function rules()
    {
        return [
            [['login'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => I18Next::t('restclient', 'identity.attributes.login'),
        ];
    }

}