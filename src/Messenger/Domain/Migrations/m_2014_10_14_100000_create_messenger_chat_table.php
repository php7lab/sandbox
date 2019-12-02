<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

if ( ! class_exists(m_2014_10_14_100000_create_messenger_chat_table::class)) {

    class m_2014_10_14_100000_create_messenger_chat_table extends BaseCreateTableMigration
    {

        protected $tableName = 'messenger_chat';
        protected $tableComment = 'Чат';

        public function tableSchema()
        {
            return function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->enum('type', ['dialog', 'chat', 'channel'])->comment('Тип чата');
                $table->string('title')->comment('Название чата');
            };
        }

    }

}