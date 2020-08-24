<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('designation')->comment('1 for ceo 2 for director 3 for founder 4 co founder');
            $table->string('name');
            $table->string('ar_name')->collation('utf8_general_ci');
            $table->string('description',5055);
            $table->string('ar_description',5055)->collation('utf8_general_ci');
            $table->string('image');
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
        Schema::dropIfExists('teams');
    }
}
