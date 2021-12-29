<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walls', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('walls')->insert([
            [
                'description' => 'Concrete/brick/stone'
            ],
            [
                'description' => 'Wood, Half concrete/brick/stone and half wood'
            ],
            [
                'description' => 'Galvanized iron/aluminum'
            ],
            [
                'description' => 'Baboo/sawali/cogon/nipa. Asbestos, Glass, Makeshift/salvaged/improvised materials'
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
        Schema::dropIfExists('walls');
    }
}
