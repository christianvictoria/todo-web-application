<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('todo_title', 20);
            $table->text('todo_content');
            $table->string('todo_attachment')->nullable();
            $table->date('todo_deadline')->nullable();
            $table->integer('assignedTo')->unsigned()->nullable();
            $table->integer('fld_isImportant')->default(0);
            $table->integer('fld_isDeleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
