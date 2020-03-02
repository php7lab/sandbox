<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

class m_2020_02_29_153640_create_item_translation_table extends BaseCreateTableMigration
{

    protected $tableName = 'reference_item_translation';
    protected $tableComment = '';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('item_id')->comment('');
            $table->string('language_code')->comment('');
            $table->string('title')->comment('');
            $table->string('short_title')->comment('');
        };
    }

}
