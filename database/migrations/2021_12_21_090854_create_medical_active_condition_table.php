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
            $table->unsignedBigInteger("medical_history_id");
            $table->string("active_medical_condition");
            $table->boolean("active_medication");
            $table->timestamps();
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
