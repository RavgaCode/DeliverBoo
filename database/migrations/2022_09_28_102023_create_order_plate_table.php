<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPlateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_plate', function (Blueprint $table) {
           // Le uniche due colonne devono essere le foreign key, niente id o timestamps
           $table->unsignedInteger('quantity');
           $table->unsignedBigInteger('plate_id');
           $table->unsignedBigInteger('order_id');
           

       //    Rendo le due colonne foreign key (FK)
           $table->foreign('plate_id')->references('id')->on('plates');
           $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_plate');
    }
}
