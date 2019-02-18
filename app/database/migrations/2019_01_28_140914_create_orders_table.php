<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ordernumber')->nullable();
            $table->integer('workshop_id')->nullable();
            $table->integer('stop_id');
            $table->string('amount')->nullable();
            $table->string('amount_comment')->nullable();
            $table->boolean('delivered')->default(0);
            $table->boolean('kkode')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *v
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
