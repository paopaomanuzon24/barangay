<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('blk');
            $table->string('street');
            $table->unsignedBigInteger('barangay_id');
            $table->string('district');
            $table->char('zip_code', 5);
            $table->string('full_address');
            $table->char('address_type', 1);
            $table->char('temporary', 1)->nullable();
            $table->date('starting_from');
            $table->string('primary_id_path');
            $table->string('primary_id_name');
            $table->string('secondary_id_path');
            $table->string('secondary_id_name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_data');
    }
}
