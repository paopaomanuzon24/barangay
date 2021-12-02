<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->char("code", 1);
            $table->string("description");
            $table->timestamps();
        });

        DB::table('genders')->insert([
            'code' => 'M',
            'description' => 'Male',
        ]);

        DB::table('genders')->insert([
            'code' => 'F',
            'description' => 'Female',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
}
