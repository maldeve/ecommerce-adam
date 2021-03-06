<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeatMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heat_maps', function (Blueprint $table) {
                $table->increments('id');
                $table->string('bucket_name');
                $table->decimal('data_throughput',11,8);
                $table->date('throughput_date');
                $table->integer('deleted')->default('0');
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
        Schema::dropIfExists('heat_maps');
    }
}
