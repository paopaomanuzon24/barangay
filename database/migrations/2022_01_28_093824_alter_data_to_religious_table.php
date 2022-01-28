<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDataToReligiousTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('religious', function (Blueprint $table) {
            //
        });

        DB::table('religious')->where("id", 1)->update(['description'=>'Christian']);
        DB::table('religious')->where("id", 2)->update(['description'=>'Roman Catholic']);
        DB::table('religious')->where("id", 3)->update(['description'=>'Islam']);
        DB::table('religious')->insert([
            [
                'description' => 'Iglesia ni Cristo'
            ],
            [
                'description' => 'Protestant'
            ],
            [
                'description' => 'Aglipayan'
            ],
            [
                'description' => 'Evangelical'
            ],
            [
                'description' => 'Christian Baptist'
            ],
            [
                'description' => 'United Church of Christ'
            ],
            [
                'description' => "Jehovah's Witness"
            ],
            [
                'description' => 'Mormon'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('religious', function (Blueprint $table) {
            //
        });
    }
}
