<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseFinancingSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_financing_source', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('house_financing_source')->insert([
            [
                'description' => 'A own resources/interest–free loans from relatives/friends'
            ],
            [
                'description' => 'Assistance, PAG-IBIG, GSIS, SSS, DBP, and others'
            ],
            [
                'description' => 'Employer assistance '
            ],
            [
                'description' => 'Private persons'
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
        Schema::dropIfExists('house_financing_source');
    }
}
