<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlotterAndComplainDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blotter_and_complain_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->unsignedBigInteger('blotter_type_id')->nullable();
            $table->unsignedBigInteger('blotter_status_id')->nullable();
            $table->longText('blotter_message')->nullable();
            $table->date('blotter_date_resolved')->nullable();
            $table->string('blotter_no')->nullable();
            $table->double('blotter_fee', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('barangay_id')->references('id')->on('barangays');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('blotter_type_id')->references('id')->on('blotter_type');
            $table->foreign('blotter_status_id')->references('id')->on('blotter_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blotter_and_complain_data');
    }
}
