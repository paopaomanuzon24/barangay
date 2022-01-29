<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangayPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay_position', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('barangay_position')->insert([
            'description' => 'Barangay Captain',
        ]);
        DB::table('barangay_position')->insert([
            'description' => 'Kagawad',
        ]);
        DB::table('barangay_position')->insert([
            'description' => 'Treasurer',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangay_position');
    }
}
