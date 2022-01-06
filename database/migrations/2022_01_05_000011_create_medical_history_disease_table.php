<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoryDiseaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_history_disease', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("medical_history_id")->nullable();
            $table->unsignedBigInteger("disease_id")->nullable();
            $table->timestamps();

            $table->foreign('medical_history_id')->references('id')->on('medical_history');
            $table->foreign('disease_id')->references('id')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_history_disease');
    }
}
