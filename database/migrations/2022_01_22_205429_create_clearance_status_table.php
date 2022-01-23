<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearanceStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_status', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('clearance_status')->insert([
            'description' => 'For Approval',
        ]);
        DB::table('clearance_status')->insert([
            'description' => 'For Release',
        ]);
        DB::table('clearance_status')->insert([
            'description' => 'For Payment',
        ]);
        DB::table('clearance_status')->insert([
            'description' => 'Denied',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clearance_status');
    }
}
