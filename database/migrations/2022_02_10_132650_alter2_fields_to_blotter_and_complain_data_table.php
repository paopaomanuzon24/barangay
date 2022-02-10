<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alter2FieldsToBlotterAndComplainDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blotter_and_complain_data', function (Blueprint $table) {
            $table->unsignedBigInteger('blotter_complainant')->nullable()->change();
            $table->unsignedBigInteger('blotter_complainee')->nullable()->change();

            $table->renameColumn('blotter_complainant', 'blotter_complainant_id');
            $table->renameColumn('blotter_complainee', 'blotter_complainee_id');

            // $table->foreign('blotter_complainant_id')->references('id')->on('users');
            // $table->foreign('blotter_complainee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blotter_and_complain_data', function (Blueprint $table) {
            //
        });
    }
}
