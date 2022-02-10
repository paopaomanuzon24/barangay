<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_provinces', function (Blueprint $table) {
            $table->id();
            $table->string('prov_code');
            $table->string('prov_name');
            $table->string('reg_code');
            $table->string('nscb_prov_code');
            $table->string('nscb_prov_name');
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
        Schema::dropIfExists('ref_provinces');
    }
}
