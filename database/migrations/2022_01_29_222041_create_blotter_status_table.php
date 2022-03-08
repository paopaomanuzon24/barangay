<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlotterStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blotter_status', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('blotter_status')->insert([
            'description' => 'Solved'
        ]);
        DB::table('blotter_status')->insert([
            'description' => 'On going'
        ]);
        DB::table('blotter_status')->insert([
            'description' => 'On court'
        ]);
        DB::table('blotter_status')->insert([
            'description' => 'Hearing'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blotter_status');
    }
}
