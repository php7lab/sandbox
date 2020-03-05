<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\models;

use yii\base\Model;

class ProjectForm extends Model
{

    public $name;
    public $title;
    public $url;

    public function rules()
    {
        return [
            [['name', 'title', 'url'], 'required'],
            ['url', 'url'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя проекта (слитно на латинице)',
            'title' => 'Название проекта',
            'url' => 'Ссылка на REST API',
        ];
    }

}