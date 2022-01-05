<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoryVaccineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_history_vaccine', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("medical_history_id")->nullable();
            $table->unsignedBigInteger("vaccine_id")->nullable();
            $table->timestamps();

            $table->foreign('medical_history_id')->references('id')->on('medical_history');
            $table->foreign('vaccine_id')->references('id')->on('vaccines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_history_vaccine');
    }
}
