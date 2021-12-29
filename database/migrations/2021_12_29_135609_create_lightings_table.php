<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLightingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lightings', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('lightings')->insert([
            [
                'description' => 'Electricity'
            ],
            [
                'description' => 'Kerosene (gaas) '
            ],
            [
                'description' => 'Liquefied petroleum (LPG)'
            ],
            [
                'description' => 'Oil (vegetable, animal, and others) '
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
        Schema::dropIfExists('lightings');
    }
}
