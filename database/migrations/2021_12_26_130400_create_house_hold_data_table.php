<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseHoldDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_hold_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("type_building_house_id")->nullable();
            $table->unsignedBigInteger("roof_id")->nullable();
            $table->string("roof_specify")->nullable();
            $table->unsignedBigInteger("outer_wall_id")->nullable();
            $table->string("outer_wall_specify")->nullable();
            $table->unsignedBigInteger("state_repair_id")->nullable();
            $table->unsignedBigInteger("year_built_id")->nullable();
            $table->unsignedBigInteger("floor_area_id")->nullable();
            $table->unsignedBigInteger("lighting_id")->nullable();
            $table->unsignedBigInteger("cooking_id")->nullable();
            $table->string("other_source_water")->nullable();
            $table->unsignedBigInteger("house_status_id")->nullable();
            $table->unsignedBigInteger("house_acquisition_id")->nullable();
            $table->string("house_acquisition_specify")->nullable();
            $table->unsignedBigInteger("house_finance_id")->nullable();
            $table->string("house_finance_specify")->nullable();
            $table->unsignedBigInteger("house_rental_id")->nullable();
            $table->unsignedBigInteger("lot_status_id")->nullable();
            $table->unsignedBigInteger("garbage_disposal_id")->nullable();
            $table->string("garbage_disposal_specify")->nullable();
            $table->unsignedBigInteger("toilet_facilty_id")->nullable();
            $table->string("language")->nullable();
            $table->char("residence_type", 1)->nullable();
            $table->char("garage_parking", 1)->nullable();
            $table->char("septic_tank", 1)->nullable();
            $table->string("septic_tank_specify")->nullable();
            $table->string("file_name")->nullable();
            $table->string("path_name")->nullable();
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
        Schema::dropIfExists('house_hold_data');
    }
}
