<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

if ( ! class_exists(m_2020_01_16_093121_create_file_table::class)) {

    class m_2020_01_16_093121_create_file_table extends BaseCreateTableMigration
    {

        protected $tableName = 'storage_file';
        protected $tableComment = '';

        public function tableSchema()
        {
            return function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->integer('service_id')->comment('Сервис');
                $table->integer('entity_id')->comment('ID внешней сущности');
                $table->integer('author_id')->comment('Автор');
                $table->string('hash')->comment('Хэш содержимого');
                $table->string('extension')->comment('Расширение файла');
                $table->string('size')->comment('Размер файла');
                $table->string('name')->comment('Имя файла');
                $table->string('description')->comment('Описание');
                $table->string('status')->comment('Статус');
                $table->dateTime('created_at')->comment('Дата создания');
                $table->dateTime('updated_at')->comment('Дата обновления');

                $table->unique(['service_id', 'hash', 'extension', 'entity_id']);
            };
        }

    }

}