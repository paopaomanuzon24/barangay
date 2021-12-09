<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_level', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->string("description");
            $table->integer("sort")->nullable();
            $table->timestamps();
        });

        DB::table('education_level')->insert([
            [
                'code' => 'elem',
                'description' => 'Elementary'
            ],
            [
                'code' => 'jhs',
                'description' => 'Secondary - Junior'
            ],
            [
                'code' => 'shs',
                'description' => 'Secondary - Senior'
            ],
            [
                'code' => 'tertiary',
                'description' => 'Tertiary'
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
        Schema::dropIfExists('education_level');
    }
}
