<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

if ( ! class_exists(m_2020_02_19_181256_create_project_table::class)) {

    class m_2020_02_19_181256_create_project_table extends BaseCreateTableMigration
    {

        protected $tableName = 'restclient_project';
        protected $tableComment = '';

        public function tableSchema()
        {
            return function (Blueprint $table) {
                $table->integer('id')->autoIncrement()->comment('Идентификатор');
                $table->string('name')->unique()->comment('');
                $table->string('title')->comment('');
                $table->string('url')->unique()->comment('');
                $table->smallInteger('status')->comment('Статус');
            };
        }

    }

}