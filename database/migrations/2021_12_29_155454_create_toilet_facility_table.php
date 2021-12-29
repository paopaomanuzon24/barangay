<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToiletFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toilet_facility', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('toilet_facility')->insert([
            [
                'description' => 'Water-sealed, sewer septic tank used exclusively by household'
            ],
            [
                'description' => 'Water-sealed, sewer septic tank, shared with other households'
            ],
            [
                'description' => 'Water-sealed, other depository, used exclusively by household'
            ],
            [
                'description' => 'Water-sealed, other depository, shared with other households'
            ],
            [
                'description' => 'Closed pit'
            ],
            [
                'description' => 'Open pit'
            ],
            [
                'description' => 'Others (pail system and others)'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toilet_facility');
    }
}
