<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_type', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('blood_type')->insert([
            'description' => 'A+'
        ]);
        DB::table('blood_type')->insert([
            'description' => 'O+'
        ]);
        DB::table('blood_type')->insert([
            'description' => 'B+'
        ]);
        DB::table('blood_type')->insert([
            'description' => 'AB+'
        ]);
        DB::table('blood_type')->insert([
            'description' => 'A-'
        ]);
        DB::table('blood_type')->insert([
            'description' => 'O-'
        ]);
        DB::table('blood_type')->insert([
            'description' => 'B-'
        ]);
        DB::table('blood_type')->insert([
            'description' => 'AB-'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_type');
    }
}
