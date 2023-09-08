<?php

use App\Globals\Constants;
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
            $table->string('order_num')->unique();
            $table->foreignId('user_created_id')->constrained(
                'users'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('phone');
            $table->string("customer_name");
            $table->dateTime('shipping_date');
            $table->dateTime('expected_date');
            $table->string('shipping_address');
            $table->string('recipient_address');
            $table->foreignId('province_shipping_id')->constrained(
                'province_stocks'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('province_recipient_id')->constrained(
                'province_stocks'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('product_name');
            $table->double('shipping_fee');
            $table->integer('weight');
            $table->tinyInteger('status')->default(Constants::STATUS_ACTIVE);
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
        Schema::dropIfExists('orders');
    }
}
