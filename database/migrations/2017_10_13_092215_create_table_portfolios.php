<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePortfolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('project_title', 200);
            $table->text('project_overview')->nullable();
            $table->string('thumb_image', 200)->nullable();
            $table->string('project_file', 200)->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('project_url')->nullable();
            $table->string('completion_date', 50)->nullable();
            $table->string('skills')->nullable();
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
        Schema::dropIfExists('portfolios');
    }
}
