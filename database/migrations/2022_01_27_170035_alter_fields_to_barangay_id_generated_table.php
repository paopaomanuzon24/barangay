<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsToBarangayIdGeneratedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangay_id_generated', function (Blueprint $table) {
            $table->string("ice_first_name");
            $table->string("ice_last_name");
            $table->string("ice_middle_name");
            $table->string("ice_address");
            $table->string("ice_contact_no");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangay_id_generated', function (Blueprint $table) {
            //
        });
    }
}
