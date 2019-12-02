<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;
use PhpLab\Eloquent\Migration\Enums\ForeignActionEnum;

if ( ! class_exists(m_2014_10_14_300000_create_messenger_message_table::class)) {

    class m_2014_10_14_300000_create_messenger_message_table extends BaseCreateTableMigration
    {

        protected $tableName = 'messenger_message';
        protected $tableComment = 'Содержимое сообщений';

        public function tableSchema()
        {
            return function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->integer('author_id')->comment('ID автора');
                //$table->string('chat_id')->comment('');
                $table->string('text')->comment('');

                $table
                    ->foreign('author_id')
                    ->references('id')
                    ->on($this->encodeTableName('messenger_member'))
                    ->onDelete(ForeignActionEnum::CASCADE)
                    ->onUpdate(ForeignActionEnum::CASCADE);
            };
        }

    }

}