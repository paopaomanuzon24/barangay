<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingHouseTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_house_type', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('building_house_type')->insert([
            [
                'description' => 'Single House'
            ],
            [
                'description' => 'Duplex'
            ],
            [
                'description' => 'Multi-Unit Residential'
            ],
            [
                'description' => 'Commercial/Industrial/Agricultural'
            ],
            [
                'description' => 'Institutional living quarter- (hotel, hospital, and others)'
            ],
            [
                'description' => 'other Housing units (boat, cave and others)'
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
        Schema::dropIfExists('building_house_type');
    }
}
