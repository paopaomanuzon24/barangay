<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangayIdSequenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay_id_sequence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id');
            $table->string('current_year');
            $table->bigInteger('sequence');
            $table->timestamps();

            $table->foreign('barangay_id')->references('id')->on('barangays');
        });

        DB::table('barangay_id_sequence')->insert([
            [
                'barangay_id' => 1,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 2,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 3,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 4,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 5,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 6,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 7,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 8,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 9,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 10,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 11,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 12,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 13,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 14,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 15,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 16,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 17,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 18,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 19,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 20,
                'current_year' => date('Y'),
                'sequence' => 0,
            ],
            [
                'barangay_id' => 21,
                'current_year' => date('Y'),
                'sequence' => 0,
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
        Schema::dropIfExists('barangay_id_sequence');
    }
}
