<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeightTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('height_type', function (Blueprint $table) {
            $table->id();
            $table->string("code")->nullable();
            $table->string("description")->nullable();
            $table->timestamps();
        });

        DB::table('height_type')->insert([
            [
                'code' => 'ft',
                'description' => 'Feet'
            ],
            [
                'code' => 'cm',
                'description' => 'Centimeter'
            ],
            [
                'code' => 'in',
                'description' => 'Inch'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('height_type');
    }
}
