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
            $table->id();
            $table->string('transaction_code');
            $table->unsignedBigInteger('menu_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('chef_id');
            $table->unsignedBigInteger('waiter_id');
            $table->timestamps();

            $table->foreign('menu_id')->on('menus')->references('id');
            $table->foreign('chef_id')->on('chefs')->references('id');
            $table->foreign('waiter_id')->on('waiters')->references('id');
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
