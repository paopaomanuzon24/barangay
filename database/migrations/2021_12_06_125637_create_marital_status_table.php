<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaritalStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marital_status', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('marital_status')->insert([
            [
                'description' => 'Single'
            ],
            [
                'description' => 'Married'
            ],
            [
                'description' => 'Widowed'
            ],
            [
                'description' => 'Divorced/Separated'
            ],
            [
                'description' => 'Common-Law'
            ],
            [
                'description' => 'Live-in'
            ],
            [
                'description' => 'Unknown'
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
        Schema::dropIfExists('marital_status');
    }
}
