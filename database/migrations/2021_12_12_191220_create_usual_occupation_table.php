<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsualOccupationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usual_occupation', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('usual_occupation')->insert([
            [
                'description' => 'Student'
            ],
            [
                'description' => 'Housekeeper'
            ],
            [
                'description' => 'Dependent'
            ],
            [
                'description' => 'Non-Gainful Activity'
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
        Schema::dropIfExists('usual_occupation');
    }
}
