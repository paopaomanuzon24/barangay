<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        // DB::table('diseases')->insert([
        //     [
        //         'description' => 'Diabetes'
        //     ],
        //     [
        //         'description' => 'Tuberculosis'
        //     ],
        //     [
        //         'description' => 'Hypertension'
        //     ],
        //     [
        //         'description' => 'Stroke'
        //     ]
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diseases');
    }
}
