<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseKeeperTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_keeper_type', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('house_keeper_type')->insert([
            [
                'description' => 'Nanny'
            ],
            [
                'description' => 'Driver'
            ],
            [
                'description' => 'Cook'
            ],
            [
                'description' => 'All Around'
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
        Schema::dropIfExists('house_keeper_type');
    }
}
