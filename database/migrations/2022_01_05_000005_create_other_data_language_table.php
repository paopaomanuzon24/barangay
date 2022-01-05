<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherDataLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_data_language', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('other_data_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->foreign('other_data_id')->references('id')->on('other_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_data_language');
    }
}
