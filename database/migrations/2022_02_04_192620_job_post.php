<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->double('experience');
            $table->text('description');
            $table->text('skils');
            $table->enum('status', ['active', 'inactive']);
            $table->unsignedInteger('recruiter_id');
            $table->foreign('recruiter_id')->references('id')->on('recruiter');
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
        Schema::dropIfExists('job_post');
    }
}
