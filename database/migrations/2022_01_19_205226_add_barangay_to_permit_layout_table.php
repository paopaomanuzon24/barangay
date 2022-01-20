<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarangayToPermitLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permit_layout', function (Blueprint $table) {
            $table->unsignedBigInteger("barangay_id");
            $table->foreign('barangay_id')->references('id')->on('barangays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permit_layout', function (Blueprint $table) {
            //
        });
    }
}
