<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

if ( ! class_exists(m_2020_01_16_094221_create_service_table::class)) {

    class m_2020_01_16_093109_create_service_table extends BaseCreateTableMigration
    {

        protected $tableName = 'storage_service';
        protected $tableComment = '';

        public function tableSchema()
        {
            return function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->string('title')->comment('Название сервиса');
                $table->string('name')->comment('Имя сервиса');
                $table->string('path')->comment('Базовый путь');
                $table->smallInteger('status')->default(1)->comment('Статус');
                $table->dateTime('created_at')->comment('Время создания');
                $table->dateTime('updated_at')->nullable()->comment('Время обновления');
            };
        }

    }

}