<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostUserIdAcceptedSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accepted_schedules', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('post_user_id')->after('schedule_id');
            $table->foreign('post_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accepted_schedules', function (Blueprint $table) {
            //
        });
    }
}
