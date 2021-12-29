<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_area', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('floor_area')->insert([
            [
                'description' => 'Less than 5 sq.m./ less than 54 sq.ft.'
            ],
            [
                'description' => '5 - 9 sq.m./ 54 - 107 sq.ft.'
            ],
            [
                'description' => '10 -19 sq.m./ 108 - 209 sq.ft.'
            ],
            [
                'description' => '20 - 29 sq.m./ 210 - 317 sq.ft.'
            ],
            [
                'description' => '30 - 49 sq.m./ 318 - 532 sq.ft.'
            ],
            [
                'description' => '50 - 69 sq.m./ 533 - 748 sq.ft.'
            ],
            [
                'description' => '70 - 89 sq.m./ 749 - 963 sq.ft.'
            ],
            [
                'description' => '90 - 119 sq.m./ 964 - 1286 sq.ft.'
            ],
            [
                'description' => '120 - 149 sq.m./ 1287 - 1609 sq.ft.'
            ],
            [
                'description' => '150 - 199 sq.m./ 1610 - 2147 sq.ft.'
            ],
            [
                'description' => '200 sq.m. and over/ 2148 sq.ft. and over'
            ],
            [
                'description' => 'Not applicable'
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
        Schema::dropIfExists('floor_area');
    }
}
