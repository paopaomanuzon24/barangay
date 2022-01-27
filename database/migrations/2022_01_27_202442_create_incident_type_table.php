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
            'description' => 'Near Miss Reports'
        ]);
        DB::table('incident_type')->insert([
            'description' => 'Injury and Lost Time Incident Report'
        ]);
        DB::table('incident_type')->insert([
            'description' => 'Exposure Incident Report'
        ]);
        DB::table('incident_type')->insert([
            'description' => 'Sentinel Event Report'
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
