<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearBuiltTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_built', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('year_built')->insert([
            [
                'description' => '1970 or earlier'
            ],
            [
                'description' => '1971-1980'
            ],
            [
                'description' => '1981-1990'
            ],
            [
                'description' => '1191-2000'
            ],
            [
                'description' => '2001-2005'
            ],
            [
                'description' => '2006-2010'
            ],
            [
                'description' => '2011-2015'
            ],
            [
                'description' => '2016-2020'
            ],
            [
                'description' => '2021-2025'
            ],
            [
                'description' => 'Not applicable'
            ],
            [
                'description' => 'Dont know'
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
        Schema::dropIfExists('year_built');
    }
}
