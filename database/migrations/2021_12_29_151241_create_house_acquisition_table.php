<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseAcquisitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_acquisition', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('house_acquisition')->insert([
            [
                'description' => 'Inherited'
            ],
            [
                'description' => 'Gift'
            ],
            [
                'description' => 'Company benefit'
            ],
            [
                'description' => 'Purchased'
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
        Schema::dropIfExists('house_acquisition');
    }
}
