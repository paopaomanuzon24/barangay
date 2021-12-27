<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conveniences', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('conveniences')->insert([
            [
                'description' => 'Radio'
            ],
            [
                'description' => 'Television set'
            ],
            [
                'description' => 'CD / DVD / VCD'
            ],
            [
                'description' => 'Component stereo set'
            ],
            [
                'description' => 'Landline / Wireless phone'
            ],
            [
                'description' => 'Cellular phone'
            ],
            [
                'description' => 'Personal computer ( Desktop, Laptop )'
            ],
            [
                'description' => 'Refrigerator'
            ],
            [
                'description' => 'Cooking range'
            ],
            [
                'description' => 'Washing machine'
            ],
            [
                'description' => 'Car / Jeep / Van'
            ],
            [
                'description' => 'Motorcycle / Trcycle'
            ],
            [
                'description' => 'Motorized boat / banca'
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
        Schema::dropIfExists('conveniences');
    }
}
