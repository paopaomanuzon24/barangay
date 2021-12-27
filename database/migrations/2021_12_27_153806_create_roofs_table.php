<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roofs', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('roofs')->insert([
            [
                'description' => 'Galvanized iron/aluminum'
            ],
            [
                'description' => 'Tile concrete/clay tile'
            ],
            [
                'description' => 'Half Galvanize iron, and half concrete'
            ],
            [
                'description' => 'Wood, Cogon/nipa/anahaw'
            ],
            [
                'description' => 'Asbestos'
            ],
            [
                'description' => 'Makeshift/salvaged/improvised materials'
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
        Schema::dropIfExists('roofs');
    }
}
