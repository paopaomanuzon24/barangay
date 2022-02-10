<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_cities', function (Blueprint $table) {
            $table->id();
            $table->string('city_code');
            $table->string('city_name');
            $table->string('reg_code');
            $table->string('prov_code');
            $table->string('nscb_city_code');
            $table->string('nscb_city_name');
            $table->string('city_classification');
            $table->string('chartered');
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
        Schema::dropIfExists('ref_cities');
    }
}
