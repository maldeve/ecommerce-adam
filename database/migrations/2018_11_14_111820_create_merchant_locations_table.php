<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district')->nullable();
            $table->string('bs_name');
            $table->string('equipment');
            $table->string('client_type');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('address')->nullable();
            $table->string('equipment1');
            $table->string('ip_address')->nullable();
            $table->string('bucket_name');
            $table->float('latitude',12,8);
            $table->float('longitude',12,8);
            $table->string('bucket_name_ip');
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
        Schema::dropIfExists('merchant_locations');
    }
}
