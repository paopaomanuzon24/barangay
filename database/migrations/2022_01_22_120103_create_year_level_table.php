<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_level', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->string('level_code');
            $table->string('description');
            $table->timestamps();
        });

        # Elem
        DB::table('year_level')->insert([
            'level_id' => 1,
            'level_code' => 'elem',
            'description' => 'Grade 1',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 1,
            'level_code' => 'elem',
            'description' => 'Grade 2',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 1,
            'level_code' => 'elem',
            'description' => 'Grade 3',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 1,
            'level_code' => 'elem',
            'description' => 'Grade 4',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 1,
            'level_code' => 'elem',
            'description' => 'Grade 5',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 1,
            'level_code' => 'elem',
            'description' => 'Grade 6',
        ]);

        # JHS
        DB::table('year_level')->insert([
            'level_id' => 2,
            'level_code' => 'jhs',
            'description' => 'Grade 7',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 2,
            'level_code' => 'jhs',
            'description' => 'Grade 8',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 2,
            'level_code' => 'jhs',
            'description' => 'Grade 9',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 2,
            'level_code' => 'jhs',
            'description' => 'Grade 10',
        ]);

        # SHS
        DB::table('year_level')->insert([
            'level_id' => 3,
            'level_code' => 'shs',
            'description' => 'Grade 11',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 3,
            'level_code' => 'shs',
            'description' => 'Grade 12',
        ]);

        # Tertiary
        DB::table('year_level')->insert([
            'level_id' => 4,
            'level_code' => 'tertiary',
            'description' => '1st year',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 4,
            'level_code' => 'tertiary',
            'description' => '2nd year',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 4,
            'level_code' => 'tertiary',
            'description' => '3rd year',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 4,
            'level_code' => 'tertiary',
            'description' => '4th year',
        ]);
        DB::table('year_level')->insert([
            'level_id' => 4,
            'level_code' => 'tertiary',
            'description' => '5th year',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('year_level');
    }
}
