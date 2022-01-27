<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('incident_type_id')->nullable();
            $table->unsignedBigInteger('incident_status_id')->nullable();
            $table->string('incident_message')->nullable();
            $table->string('incident_address')->nullable();
            $table->string('incident_latitude')->nullable();
            $table->string('incident_longitude')->nullable();
            $table->boolean('mark_as_read')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('incident_type_id')->references('id')->on('incident_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_data');
    }
}
