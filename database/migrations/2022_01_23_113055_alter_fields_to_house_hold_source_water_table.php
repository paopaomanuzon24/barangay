<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsToHouseHoldSourceWaterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('house_hold_source_water', function (Blueprint $table) {
            $table->dropForeign('house_hold_source_water_house_hold_id_foreign');
            $table->renameColumn('house_hold_id', 'user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('house_hold_source_water', function (Blueprint $table) {
            //
        });
    }
}
