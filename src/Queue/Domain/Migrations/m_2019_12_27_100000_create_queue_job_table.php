<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

if ( ! class_exists(m_2019_12_27_100000_create_queue_job_table::class)) {

    class m_2019_12_27_100000_create_queue_job_table extends BaseCreateTableMigration
    {

        protected $tableName = 'queue_job';
        protected $tableComment = 'Очередь задач';

        public function tableSchema()
        {
            return function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->string('channel')->comment('Имя канала потока обработки');
                $table->string('class')->comment('Имя класса');
                $table->text('data')->comment('Данные для задачи');
                $table->integer('priority')->default(1024)->comment('Приоритет выполнения');
                $table->integer('delay')->default(0)->comment('Допустимая задержка');
                $table->integer('attempt')->default(0)->comment('Номер попытки выполнения');
                $table->integer('pushed_at')->comment('Время создания');
                $table->integer('reserved_at')->nullable()->comment('Время резервирования задачи для выполнения');
                $table->integer('done_at')->nullable()->comment('Время завершения выполнения задачи');

                $table->index(['channel']);
                $table->index(['priority']);
                $table->index(['reserved_at']);
            };
        }

    }

}