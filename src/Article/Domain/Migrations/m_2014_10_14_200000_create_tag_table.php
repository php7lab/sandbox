<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;
use PhpLab\Eloquent\Migration\Enums\ForeignActionEnum;

if ( ! class_exists(m_2014_10_14_200000_create_tag_table::class)) {

    class m_2014_10_14_200000_create_tag_table extends BaseCreateTableMigration
    {

        protected $tableName = 'article_tag';
        protected $tableComment = 'Тэги статей';

        public function tableSchema()
        {
            return function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->string('title')->comment('Заголовок статьи');
            };
        }

    }

}
