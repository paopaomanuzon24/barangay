<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->string("description");
            $table->timestamps();
        });

        DB::table('documents')->insert([
            [
                'type' => 'P',
                'description' => 'Passport'
            ],
            [
                'type' => 'P',
                'description' => "Driver's License"
            ],
            [
                'type' => 'P',
                'description' => 'UMID'
            ],
            [
                'type' => 'P',
                'description' => 'PhilHealth ID'
            ],
            [
                'type' => 'P',
                'description' => 'TIN ID'
            ],
            [
                'type' => 'P',
                'description' => 'Postal ID'
            ],
            [
                'type' => 'P',
                'description' => "Voter's ID"
            ],
            [
                'type' => 'P',
                'description' => 'Senior Citizen ID'
            ],
            [
                'type' => 'P',
                'description' => 'OFW ID'
            ],
            [
                'type' => 'P',
                'description' => 'PRC ID'
            ],
            [
                'type' => 'P',
                'description' => 'National ID'
            ]
        ]);

        DB::table('documents')->insert([
            [
                'type' => 'S',
                'description' => 'NBI Clearance'
            ],
            [
                'type' => 'S',
                'description' => 'Police Clearance'
            ],
            [
                'type' => 'S',
                'description' => 'Barangay Clearance'
            ],
            [
                'type' => 'S',
                'description' => 'Birth Certificate'
            ],
            [
                'type' => 'S',
                'description' => 'Marriage Certificate'
            ],
            [
                'type' => 'S',
                'description' => 'Community Tax Certificate (Cedula)'
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
        Schema::dropIfExists('documents');
    }
}
