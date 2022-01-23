<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearanceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("barangay_id");
            $table->string("clearance_name");
            $table->double('fee',20,2);
            $table->timestamps();

            $table->foreign('barangay_id')->references('id')->on('barangays');
        });

        DB::table('clearance_type')->insert([
            'barangay_id' => '1',
            'clearance_name' => 'Indigency',
            'fee' => 10,
        ]);
        DB::table('clearance_type')->insert([
            'barangay_id' => '1',
            'clearance_name' => 'Recidency',
            'fee' => 20,
        ]);
        DB::table('clearance_type')->insert([
            'barangay_id' => '2',
            'clearance_name' => 'Barangay',
            'fee' => 20,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clearance_type');
    }
}
