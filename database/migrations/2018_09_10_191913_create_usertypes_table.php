<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsertypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertypes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_type');
            $table->timestamps();
        });

        DB::table ('usertypes')->insert(
            array(
                ['user_type' =>'1'],
                ['user_type' =>'2'],
                ['user_type' =>'3']
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
        Schema::dropIfExists('usertypes');
    }
}
