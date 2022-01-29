<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alter4FieldsToMedicalHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_history', function (Blueprint $table) {
            $table->unsignedBigInteger("height_type_id")->nullable();
            $table->unsignedBigInteger("weight_type_id")->nullable();

            $table->foreign('height_type_id')->references('id')->on('height_type');
            $table->foreign('weight_type_id')->references('id')->on('weight_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_history', function (Blueprint $table) {
            //
        });
    }
}
