<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_process', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained(
                'orders'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('employee_assign_id')->constrained(
                'users'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('stock_id')->constrained(
                'province_stocks'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('order_process');
    }
}
