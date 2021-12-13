<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship_type', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->string("description");
            $table->timestamps();
        });

        DB::table('relationship_type')->insert([
            [
                'code' => 'F',
                'description' => 'Father'
            ],
            [
                'code' => 'M',
                'description' => 'Mother'
            ],
            [
                'code' => 'S',
                'description' => 'Siblings'
            ],
            [
                'code' => 'H',
                'description' => 'House Maid'
            ],
            [
                'code' => 'D',
                'description' => 'Driver'
            ],
            [
                'code' => 'C',
                'description' => 'Cook'
            ],
            [
                'code' => 'N',
                'description' => 'Nanny'
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
        Schema::dropIfExists('relationship_type');
    }
}
