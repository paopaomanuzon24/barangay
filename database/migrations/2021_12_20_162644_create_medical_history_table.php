<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("height");
            $table->string("weight");
            $table->string("blood_type");
            $table->string("smoke_no");
            $table->string("alocohol_no");
            $table->string("alcohol_status");
            $table->boolean("commorbidity");
            $table->string("active_medical_condition");
            $table->boolean("active_medication");
            $table->string("allergies");
            $table->string("vaccination");
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
        Schema::dropIfExists('medical_history');
    }
}
