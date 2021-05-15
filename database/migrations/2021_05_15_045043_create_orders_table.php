<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedInteger('dish_id');
            $table->integer('quantity');
            $table->decimal('sub_total', $precision = 8, $scale = 2);
            $table->decimal('tax', $precision = 8, $scale = 2)->nullable();
            $table->decimal('discount', $precision = 8, $scale = 2)->nullable();
            $table->decimal('total', $precision = 8, $scale = 2);
            $table->unsignedInteger('user_id');  
            $table->timestamps();
            $table->foreign('dish_id')
            ->references('id')
            ->on('dishes'); 
            $table->foreign('user_id')
            ->references('id')
            ->on('users');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
