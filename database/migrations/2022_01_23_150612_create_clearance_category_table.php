<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearanceCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_category', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->unsignedBigInteger("barangay_id");
            $table->timestamps();
        });

        DB::table('clearance_category')->insert([
            'description' => 'Clearance Category',
            'barangay_id' => '1',

        ]);
        DB::table('clearance_category')->insert([
            'description' => 'Barangay Clearance',
            'barangay_id' => '1',

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clearance_category');
    }
}
