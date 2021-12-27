<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseHoldSourceWaterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_hold_source_water', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("house_hold_id");
            $table->unsignedBigInteger("source_water_id");
            $table->boolean("drinking");
            $table->boolean("cooking");
            $table->boolean("laundry");
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
        Schema::dropIfExists('house_hold_source_water');
    }
}
