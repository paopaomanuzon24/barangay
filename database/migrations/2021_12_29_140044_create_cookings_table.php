<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cookings', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('cookings')->insert([
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
                'description' => 'Charcoal'
            ],
            [
                'description' => 'Wood'
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
        Schema::dropIfExists('cookings');
    }
}
