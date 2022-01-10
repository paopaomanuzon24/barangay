<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseHoldInternetAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_hold_internet_access', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("house_hold_id")->nullable();
            $table->unsignedBigInteger("internet_access_id")->nullable();
            $table->timestamps();

            $table->foreign('house_hold_id')->references('id')->on('house_hold_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_hold_internet_access');
    }
}
