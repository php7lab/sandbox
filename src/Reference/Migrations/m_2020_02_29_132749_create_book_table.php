<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

class m_2020_02_29_132749_create_book_table extends BaseCreateTableMigration
{

    protected $tableName = 'reference_book';
    protected $tableComment = '';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('title')->comment('');
            $table->string('levels')->comment('');
            $table->string('entity')->comment('');
            $table->string('props')->comment('');
            $table->smallInteger('status')->comment('Статус');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->nullable()->comment('Время обновления');
        };
    }

}
