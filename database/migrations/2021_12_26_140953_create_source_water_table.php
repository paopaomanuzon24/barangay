<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourceWaterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_water', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('source_water')->insert([
            [
                'description' => 'Own use, faucet community water system'
            ],
            [
                'description' => 'Shared, faucet community water system'
            ],
            [
                'description' => 'Own use, tubed/piped deep well ( at least 30m deep )'
            ],
            [
                'description' => 'Shared, tubed/piped deep well'
            ],
            [
                'description' => 'Tubed/piped shallow well'
            ],
            [
                'description' => 'Dug Well'
            ],
            [
                'description' => 'Protected spring'
            ],
            [
                'description' => 'Unprotected spring'
            ],
            [
                'description' => 'Lake, river, rain and others'
            ],
            [
                'description' => 'Peddler'
            ],
            [
                'description' => 'Bottled water'
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
        Schema::dropIfExists('source_water');
    }
}
