<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseHoldPresenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_hold_presence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("house_hold_id");
            $table->unsignedBigInteger("house_hold_presence_id");
            $table->timestamps();

            $table->foreign('house_hold_id')->references('id')->on('house_hold_data');
            $table->foreign('house_hold_presence_id')->references('id')->on('conveniences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_hold_presence');
    }
}
