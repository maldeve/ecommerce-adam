<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order__statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_status');
            $table->timestamps();
        });

        DB::table ('order__statuses')->insert(
            array(
                ['order_status' =>'1'],
                ['order_status' =>'2']
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order__statuses');
    }
}
