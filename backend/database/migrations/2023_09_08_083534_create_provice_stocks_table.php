<?php

use App\Globals\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviceStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('province_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('point_x');
            $table->integer('point_y');
            $table->tinyInteger('type')->default(Constants::TYPE_STOCK);
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
        Schema::dropIfExists('provice_stocks');
    }
}
