<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkAffiliationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_affiliation', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('work_affiliation')->insert([
            [
                'description' => 'Medical'
            ],
            [
                'description' => 'Security'
            ],
            [
                'description' => 'Banking'
            ],
            [
                'description' => 'Academe'
            ],
            [
                'description' => 'Information Technology'
            ],
            [
                'description' => 'BPO'
            ],
            [
                'description' => 'Services'
            ],
            [
                'description' => 'Delivery'
            ],
            [
                'description' => 'Customer Service'
            ],
            [
                'description' => 'LGU'
            ],
            [
                'description' => 'National Government'
            ],
            [
                'description' => 'Non-Profit Organization'
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
        Schema::dropIfExists('work_affiliation');
    }
}
