<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNonResidenceDataToUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_type', function (Blueprint $table) {
            //
        });

        DB::table('user_type')->insert([
            'name' => 'non-resident',
            'level' => 7,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_type', function (Blueprint $table) {
            //
        });
    }
}
