<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalActiveConditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_active_condition', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("medical_history_id")->nullable();
            $table->string("active_medical_condition");
            $table->boolean("active_medication");
            $table->timestamps();

            $table->foreign('medical_history_id')->references('id')->on('medical_history');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_active_condition');
    }
}
