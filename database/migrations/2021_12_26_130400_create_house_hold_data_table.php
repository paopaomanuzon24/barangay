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
            $table->unsignedBigInteger("type_building_house_id");
            $table->unsignedBigInteger("roof_id");
            $table->string("roof_specify");
            $table->unsignedBigInteger("outer_wall_id");
            $table->string("outer_wall_specify");
            $table->unsignedBigInteger("state_repair_id");
            $table->unsignedBigInteger("year_built_id");
            $table->unsignedBigInteger("floor_area_id");
            $table->unsignedBigInteger("lighting_id");
            $table->unsignedBigInteger("cooking_id");
            $table->string("other_source_water");
            $table->unsignedBigInteger("house_status_id");
            $table->unsignedBigInteger("house_acquisition_id");
            $table->string("house_acquisition_specify");
            $table->unsignedBigInteger("house_finance_id");
            $table->string("house_finance_specify");
            $table->unsignedBigInteger("house_rental_id");
            $table->unsignedBigInteger("lot_status_id");
            $table->unsignedBigInteger("garbage_disposal_id");
            $table->string("garbage_disposal_specify");
            $table->unsignedBigInteger("toilet_facilty_id");
            $table->string("language");
            $table->char("residence_type", 1);
            // $table->char("internet_access_type", 1);
            $table->char("garage_parking", 1);
            $table->char("septic_tank", 1);
            $table->string("septic_tank_specify");
            $table->string("file_name");
            $table->string("path_name");
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
