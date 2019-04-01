<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('route');
            $table->time('time');
            $table->boolean('active')->default(0);
            $table->boolean('started')->default(0);
            $table->boolean('finished')->default(0);
            $table->time('started_time')->nullable();
            $table->time('finished_time')->nullable();
            $table->integer('kmstart')->nullable();
            $table->integer('kmend')->nullable();
            $table->integer('driver_id')->nullable();
            $table->boolean('optimized')->default(0);
            $table->boolean('optimized')->default(0);
            $table->time('optimized_time')->nullable();
            $table->integer('optimized_km')->nullable();
            $table->time('time_diff')->nullable();
            $table->integer('km_diff')->nullable();
            $table->boolean('lunch_break')->default(0);
            $table->time('lunch_start')->nullable();
            $table->time('lunch_end')->nullable();
            $table->longText('map_polylines')->nullable();
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
        Schema::dropIfExists('routes');
    }
}
