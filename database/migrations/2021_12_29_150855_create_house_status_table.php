<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_status', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('house_status')->insert([
            [
                'description' => 'Owned/being Amortized'
            ],
            [
                'description' => 'Rented'
            ],
            [
                'description' => 'Rent-Free with consent of owner'
            ],
            [
                'description' => 'Rent Free without consent of owner'
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
        Schema::dropIfExists('house_status');
    }
}
