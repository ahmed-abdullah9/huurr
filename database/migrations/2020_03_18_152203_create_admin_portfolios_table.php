<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ar_name')->collation('utf8_general_ci');
            $table->string('skill');
            $table->string('profile_link')->nullable();
            $table->string('ar_skill')->collation('utf8_general_ci');
            $table->string('image');
            $table->integer('demension');
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
        Schema::dropIfExists('admin_portfolios');
    }
}
