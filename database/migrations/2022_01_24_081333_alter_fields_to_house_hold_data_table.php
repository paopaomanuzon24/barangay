<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsToHouseHoldDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('house_hold_data', function (Blueprint $table) {
            $table->dropForeign('house_hold_data_toilet_facilty_id_foreign');
            $table->renameColumn('toilet_facilty_id', 'toilet_facility_id');
            $table->foreign('toilet_facility_id')->references('id')->on('toilet_facility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('house_hold_data', function (Blueprint $table) {
            //
        });
    }
}
