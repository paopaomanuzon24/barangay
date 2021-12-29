<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarbageDisposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garbage_disposal', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('garbage_disposal')->insert([
            [
                'description' => 'Picked up by garbage truck'
            ],
            [
                'description' => 'Dumping in individual pit (not burned)'
            ],
            [
                'description' => 'Burning, Composting'
            ],
            [
                'description' => 'Burying'
            ],
            [
                'description' => 'Feeding to animals'
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
        Schema::dropIfExists('garbage_disposal');
    }
}
