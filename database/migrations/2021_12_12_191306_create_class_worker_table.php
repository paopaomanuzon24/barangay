<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_worker', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('class_worker')->insert([
            [
                'description' => '(1) Worked for private household (domestic services)'
            ],
            [
                'description' => '(2) Worked for private business/enterprise/farm'
            ],
            [
                'description' => '(3) Worked for government/government corporation'
            ],
            [
                'description' => '(4) Self-employed without any paid employee'
            ],
            [
                'description' => '(5) Employer in own farm or business'
            ],
            [
                'description' => '(6) Worked with pay in own family-operated farm or business'
            ],
            [
                'description' => '(7) Worked without pay in own family-operated farm or business - UNPAID'
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
        Schema::dropIfExists('class_worker');
    }
}
