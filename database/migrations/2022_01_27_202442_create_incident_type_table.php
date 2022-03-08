<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_type', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('incident_type')->insert([
            'description' => 'Near Miss'
        ]);
        DB::table('incident_type')->insert([
            'description' => 'Injury and Lost Time Incident'
        ]);
        DB::table('incident_type')->insert([
            'description' => 'Exposure Incident'
        ]);
        DB::table('incident_type')->insert([
            'description' => 'Sentinel Event'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_type');
    }
}
