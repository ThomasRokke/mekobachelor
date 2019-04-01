<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWtestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wtests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orgnr');
            $table->string('name');
            $table->string('adr');
            $table->integer('zip');
            $table->string('city');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('place_id')->nullable();

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
        Schema::dropIfExists('wtests');
    }
}
