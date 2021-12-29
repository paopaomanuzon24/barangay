<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_status', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('lot_status')->insert([
            [
                'description' => 'Owned/being amortized'
            ],
            [
                'description' => 'Rented, Rent-free with consent of owner'
            ],
            [
                'description' => 'Rent-free without consent of owner'
            ],
            [
                'description' => 'Not applicable'
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
        Schema::dropIfExists('lot_status');
    }
}
