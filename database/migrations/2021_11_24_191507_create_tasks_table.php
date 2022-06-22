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
        // TODO: files, comments
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('executor_id');
            $table->foreignId('client_id');
            $table->text('short_description');
            $table->text('full_description');
            $table->string('type');
            $table->string('status');
            $table->string('priority');
            $table->text('tech_comment')->nullable();
            $table->text('client_comment')->nullable();
            $table->integer('executor_time');
            $table->timestamps();
            $table->timestamp('deadline_at');
            $table->timestamp('finished_at');
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
