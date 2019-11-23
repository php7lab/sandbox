<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;
use PhpLab\Eloquent\Migration\Enum\ForeignActionEnum;

if ( ! class_exists(m_2014_10_14_400000_create_messenger_content_flow_table::class)) {

    class m_2014_10_14_400000_create_messenger_content_flow_table extends BaseCreateTableMigration
    {

        protected $tableName = 'messenger_content_flow';
        protected $tableComment = 'Поток сообщений';

        public function tableSchema()
        {
            return function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->integer('content_id')->comment('');
                $table->integer('chat_id')->comment('');
                $table
                    ->foreign('content_id')
                    ->references('id')
                    ->on($this->encodeTableName('messenger_content'))
                    ->onDelete(ForeignActionEnum::CASCADE)
                    ->onUpdate(ForeignActionEnum::CASCADE);
                $table
                    ->foreign('chat_id')
                    ->references('id')
                    ->on($this->encodeTableName('messenger_chat'))
                    ->onDelete(ForeignActionEnum::CASCADE)
                    ->onUpdate(ForeignActionEnum::CASCADE);
            };
        }

    }

}