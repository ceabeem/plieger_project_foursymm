<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();;
            $table->string('task_id')->nullable();;
            $table->integer('assign')->nullable();
            $table->integer('assign_cmplt')->nullable();
            $table->integer('reassign')->nullable();
            $table->integer('review')->nullable();
            $table->integer('review_cmplt')->nullable();
            $table->integer('issue')->nullable();
            $table->integer('finish')->nullable();
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
        Schema::dropIfExists('records');
    }
}
