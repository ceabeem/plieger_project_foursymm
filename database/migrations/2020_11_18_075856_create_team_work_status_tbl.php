<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamWorkStatusTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_work_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('team_id');
            $table->string('member_id');
            $table->string('role_id');
            $table->string('name');
            $table->string('total_assigned_task')->nullable();
            $table->string('team_leader_reviewed')->nullable();
            $table->string('team_supervisor_reviewed')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('team_work_status');
    }
}
