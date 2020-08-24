<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('category', 256);
            $table->tinyInteger('job_type');
            $table->string('job_title', 256);
            $table->decimal('budget', 8, 2);
            $table->text('job_description');
            $table->string('project_type', 256);
            $table->integer('fl_number');
            $table->string('job_skills', 256)->nullable();
            $table->string('experience_level', 256);
            $table->string('job_duration', 256);
            $table->string('job_time', 256);
            $table->text('job_questions');
            $table->tinyInteger('job_cover_letter')->default(0);
            $table->tinyInteger('job_boost')->default(0);
            $table->tinyInteger('is_draft')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('jobs');
    }
}
