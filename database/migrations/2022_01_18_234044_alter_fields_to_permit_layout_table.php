<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsToPermitLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permit_layout', function (Blueprint $table) {
            $table->string('barangay_position')->nullable()->change();
            $table->string('barangay_address')->nullable()->change();
            $table->string('barangay_hotline')->nullable()->change();
            $table->string('barangay_email')->nullable()->change();
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
