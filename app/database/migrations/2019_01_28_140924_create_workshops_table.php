<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workshop_id');
            $table->integer('route')->default(10);
            $table->string('name');
            $table->string('adr')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('place_id')->nullable();
            $table->string('phone')->nullable();

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
        Schema::dropIfExists('workshops');
    }
}
