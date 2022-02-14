<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsToOtherDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_data', function (Blueprint $table) {
            $table->char('is_voter', 1)->nullable();
            $table->unsignedBigInteger('voter_city_id')->nullable();
            $table->boolean('is_single_parent')->nullable();

            $table->foreign('voter_city_id')->references('id')->on('cities');
        });

        Schema::table('personal_data', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
            // $table->foreign('province_id')->references('id')->on('provinces');
            // $table->foreign('municipality_id')->references('id')->on('municipalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_data', function (Blueprint $table) {
            //
        });
    }
}
