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

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type_building_house_id')->references('id')->on('building_house_type');
            $table->foreign('roof_id')->references('id')->on('roofs');
            $table->foreign('outer_wall_id')->references('id')->on('walls');
            $table->foreign('state_repair_id')->references('id')->on('building_house_repair');
            $table->foreign('year_built_id')->references('id')->on('year_built');
            $table->foreign('floor_area_id')->references('id')->on('floor_area');
            $table->foreign('lighting_id')->references('id')->on('lightings');
            $table->foreign('cooking_id')->references('id')->on('cookings');
            $table->foreign('house_status_id')->references('id')->on('house_status');
            $table->foreign('house_acquisition_id')->references('id')->on('house_acquisition');
            $table->foreign('house_finance_id')->references('id')->on('house_financing_source');
            $table->foreign('house_rental_id')->references('id')->on('monthly_rental');
            $table->foreign('lot_status_id')->references('id')->on('lot_status');
            $table->foreign('garbage_disposal_id')->references('id')->on('garbage_disposal');
            $table->foreign('toilet_facilty_id')->references('id')->on('toilet_facility');
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
