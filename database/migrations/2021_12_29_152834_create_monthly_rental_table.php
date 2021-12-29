<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyRentalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_rental', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('monthly_rental')->insert([
            [
                'description' => 'PhP500 or less'
            ],
            [
                'description' => 'PhP501- 1,000'
            ],
            [
                'description' => 'PhP1,001 - 1,500'
            ],
            [
                'description' => 'PhP1,501 - 2,000'
            ],
            [
                'description' => 'PhP2,001 - 4,000'
            ],
            [
                'description' => 'PhP4,001- 6,000'
            ],
            [
                'description' => 'PhP6,001 - 7,500'
            ],
            [
                'description' => 'PhP7,501 - 10,000'
            ],
            [
                'description' => 'PhP10,001 and over'
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
        Schema::dropIfExists('monthly_rental');
    }
}
