<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEthnicityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ethnicity', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('ethnicity')->insert([
            [
                'description' => 'Black'
            ],
            [
                'description' => 'Brown'
            ],
            [
                'description' => 'White'
            ],
            [
                'description' => 'Badjao'
            ],
            [
                'description' => 'Igorot'
            ],
            [
                'description' => 'Aeta'
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
        Schema::dropIfExists('ethnicity');
    }
}
