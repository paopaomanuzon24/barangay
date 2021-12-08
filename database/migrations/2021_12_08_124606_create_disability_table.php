<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disability', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('disability')->insert([
            [
                'description' => 'Seeing, even when wearing eyeglasses'
            ],
            [
                'description' => 'Hearing, even when using a hearing aid'
            ],
            [
                'description' => 'Walking or Climbing Steps'
            ],
            [
                'description' => 'Self-Caring bathing or dressing'
            ],
            [
                'description' => 'Communicating using his/her usual language'
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
        Schema::dropIfExists('disability');
    }
}
