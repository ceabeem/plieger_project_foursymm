<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewedTaskToTeamWorkStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_work_status', function (Blueprint $table) {
            $table->string('reviewed_task')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_work_status', function (Blueprint $table) {
            $table->dropColumn('reviewed_task');
        });
    }
}
