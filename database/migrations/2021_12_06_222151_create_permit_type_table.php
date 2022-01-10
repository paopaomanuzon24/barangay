<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("barangay_id");
            $table->string("permit_name");
            $table->double('fee',20,2);
            $table->timestamps();
        });

        DB::table('permit_type')->insert([
            'category_id' => '1',
            'barangay_id' => '1',
            'permit_name' => 'Sari-sari store',
            'fee' => 23,
        ]);
        DB::table('permit_type')->insert([
            'category_id' => '2',
            'barangay_id' => '1',
            'permit_name' => 'Small Building',
            'fee' => 23,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permit_type');
    }
}
