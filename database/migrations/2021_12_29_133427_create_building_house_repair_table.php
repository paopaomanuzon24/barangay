<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingHouseRepairTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_house_repair', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('building_house_repair')->insert([
            [
                'description' => 'Needs no repair/needs minor repair'
            ],
            [
                'description' => 'Needs major repair'
            ],
            [
                'description' => 'Dilapidated/condemned'
            ],
            [
                'description' => 'Under renovation/being repaired'
            ],
            [
                'description' => 'Under Construction'
            ],
            [
                'description' => 'Unfinished construction'
            ],
            [
                'description' => 'Not Applicable'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building_house_repair');
    }
}
