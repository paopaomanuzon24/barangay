<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandOwnershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_ownership', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('land_ownership')->insert([
            [
                'description' => 'Other residential land/s'
            ],
            [
                'description' => 'Agricultural land/s'
            ],
            [
                'description' => 'Agricultural land/s acquired through CARP'
            ],
            [
                'description' => 'Agrarian Reform beneficiary'
            ],
            [
                'description' => 'Other land/s'
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
        Schema::dropIfExists('land_ownership');
    }
}
