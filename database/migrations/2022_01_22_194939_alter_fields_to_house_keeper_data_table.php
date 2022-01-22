<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsToHouseKeeperDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('house_keeper_data', function (Blueprint $table) {
            $table->unsignedBigInteger("house_keeper_user_id")->nullable();

            $table->foreign('house_keeper_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('house_keeper_data', function (Blueprint $table) {
            //
        });
    }
}
