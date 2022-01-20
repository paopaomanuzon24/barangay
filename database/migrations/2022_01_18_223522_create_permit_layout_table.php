<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_layout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("template_id");
            $table->string("signatory");
            $table->string("barangay_position");
            $table->string("barangay_address");
            $table->string("barangay_hotline");
            $table->string("barangay_email");
            $table->timestamps();

            $table->foreign('template_id')->references('id')->on('permit_template');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permit_layout');
    }
}
