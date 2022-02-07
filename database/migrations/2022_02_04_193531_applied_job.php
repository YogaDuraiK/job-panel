<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppliedJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applied_job', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_seeker_id');
            $table->foreign('job_seeker_id')->references('id')->on('job_seeker');
            $table->unsignedInteger('job_post_id');
            $table->foreign('job_post_id')->references('id')->on('job_post');
            $table->unsignedInteger('recruiter_id');
            $table->foreign('recruiter_id')->references('id')->on('recruiter');
            $table->enum('status', ['applied', 'accepted', 'rejected']);
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
        Schema::dropIfExists('applied_job');
    }
}
