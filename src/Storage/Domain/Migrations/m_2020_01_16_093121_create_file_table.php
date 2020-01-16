<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;
use PhpLab\Eloquent\Migration\Enums\ForeignActionEnum;

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
                $table->integer('size')->comment('Размер файла');
                $table->string('name')->comment('Имя файла');
                $table->string('description')->comment('Описание');
                $table->smallInteger('status')->comment('Статус');
                $table->dateTime('created_at')->comment('Время создания');
                $table->dateTime('updated_at')->nullable()->comment('Время обновления');

                $table->unique(['service_id', 'hash', 'extension', 'entity_id']);
                $table
                    ->foreign('service_id')
                    ->references('id')
                    ->on($this->encodeTableName('storage_service'))
                    ->onDelete(ForeignActionEnum::CASCADE)
                    ->onUpdate(ForeignActionEnum::CASCADE);
            };
        }

    }

}