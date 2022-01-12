<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_category', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->unsignedBigInteger("barangay_id");

            $table->timestamps();
        });

        DB::table('permit_category')->insert([
            'description' => 'Business Permit',
            'barangay_id' => '1',

        ]);
        DB::table('permit_category')->insert([
            'description' => 'Building Permit',
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
        Schema::dropIfExists('permit_category');
    }
}
